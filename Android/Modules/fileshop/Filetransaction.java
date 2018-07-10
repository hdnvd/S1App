package fileshop;
import android.util.JsonReader;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.ProtocolException;
import java.net.URL;
import common.SweetDeviceManager;
import common.RemoteClass;
import common.Message;
import java.util.ArrayList;
import java.util.List;
import android.app.Activity;
public class Filetransaction extends RemoteClass{
	public Filetransaction(Activity activity){super(activity);}
	private long id;
	private String file_fid;
	private String finance_bankpaymentinfo_fid;
	public void getAll(List<Filetransaction> Filetransactions){
		try {
			String DeviceID= SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/fileshop/filetransactionlist.jsp";
			URL+="?deviceid="+DeviceID;
			JsonReader reader=getReader(URL,false,null);
			if(reader.hasNext()) {
			reader.beginArray(); 
			while (reader.hasNext())
			Filetransactions.add(getObject(reader));
		reader.endArray();
		}
		return;
		}catch (IOException e) {
		e.printStackTrace();
		}
		return;
	}
	public Filetransaction getOne(long Id)
	{
		try {
			String DeviceID = SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/fileshop/filetransaction.jsp";
			URL+="?deviceid="+DeviceID+"&id="+String.valueOf(Id);
			JsonReader reader=getReader(URL,false,null);
			return getObject(reader);
		}catch (IOException e) {
		e.printStackTrace();
		}
		return null;
	}
	private Filetransaction getObject(JsonReader reader) throws IOException {
				reader.beginObject();
				Filetransaction theFiletransaction =new Filetransaction(getActivity());
				while (reader.hasNext()) {
					String key = reader.nextName();
					if (key.equals("id")) {theFiletransaction.setId(reader.nextInt());}
					else if (key.equals("file_fid")) {theFiletransaction.setFile_fid(reader.nextString());}
					else if (key.equals("finance_bankpaymentinfo_fid")) {theFiletransaction.setFinance_bankpaymentinfo_fid(reader.nextString());}
				}
			reader.endObject();
				return theFiletransaction;
	}
	public Message Save()
	{
	try {
			String PageURL=Constants.SITEURL + "json/fa/fileshop/managefiletransaction.jsp";
			String Data = "action=btnSave_Click";
					Data+="&id=" + String.valueOf(id);
					Data+="&file_fid=" + String.valueOf(file_fid);
					Data+="&finance_bankpaymentinfo_fid=" + String.valueOf(finance_bankpaymentinfo_fid);
			JsonReader reader=getReader(PageURL,true,Data);        
       reader.beginObject();
			Message theMessage =new Message();
			while (reader.hasNext()) {
				String key = reader.nextName();
				if (key.equals("message")) {theMessage.setMessageText(reader.nextString());}
				else if (key.equals("messagetype")) {theMessage.setMessageType(reader.nextInt());}
			}
			reader.endObject();
			return theMessage;
		}catch (IOException e) {
			e.printStackTrace();
			return null;
		}
	}

}