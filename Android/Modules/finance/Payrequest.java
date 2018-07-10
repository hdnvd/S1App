package finance;
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
public class Payrequest extends RemoteClass{
	public Payrequest(Activity activity){super(activity);}
	private long id;
	private String role_systemuser_fid;
	private String request_date;
	private String price;
	private String commit_date;
	private String committype_fid;
	public void getAll(List<Payrequest> Payrequests){
		try {
			String DeviceID= SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/finance/payrequestlist.jsp";
			URL+="?deviceid="+DeviceID;
			JsonReader reader=getReader(URL,false,null);
			if(reader.hasNext()) {
			reader.beginArray(); 
			while (reader.hasNext())
			Payrequests.add(getObject(reader));
		reader.endArray();
		}
		return;
		}catch (IOException e) {
		e.printStackTrace();
		}
		return;
	}
	public Payrequest getOne(long Id)
	{
		try {
			String DeviceID = SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/finance/payrequest.jsp";
			URL+="?deviceid="+DeviceID+"&id="+String.valueOf(Id);
			JsonReader reader=getReader(URL,false,null);
			return getObject(reader);
		}catch (IOException e) {
		e.printStackTrace();
		}
		return null;
	}
	private Payrequest getObject(JsonReader reader) throws IOException {
				reader.beginObject();
				Payrequest thePayrequest =new Payrequest(getActivity());
				while (reader.hasNext()) {
					String key = reader.nextName();
					if (key.equals("id")) {thePayrequest.setId(reader.nextInt());}
					else if (key.equals("role_systemuser_fid")) {thePayrequest.setRole_systemuser_fid(reader.nextString());}
					else if (key.equals("request_date")) {thePayrequest.setRequest_date(reader.nextString());}
					else if (key.equals("price")) {thePayrequest.setPrice(reader.nextString());}
					else if (key.equals("commit_date")) {thePayrequest.setCommit_date(reader.nextString());}
					else if (key.equals("committype_fid")) {thePayrequest.setCommittype_fid(reader.nextString());}
				}
			reader.endObject();
				return thePayrequest;
	}
	public Message Save()
	{
	try {
			String PageURL=Constants.SITEURL + "json/fa/finance/managepayrequest.jsp";
			String Data = "action=btnSave_Click";
					Data+="&id=" + String.valueOf(id);
					Data+="&role_systemuser_fid=" + String.valueOf(role_systemuser_fid);
					Data+="&request_date=" + String.valueOf(request_date);
					Data+="&price=" + String.valueOf(price);
					Data+="&commit_date=" + String.valueOf(commit_date);
					Data+="&committype_fid=" + String.valueOf(committype_fid);
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