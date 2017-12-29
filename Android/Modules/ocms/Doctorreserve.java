package ocms;
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
public class Doctorreserve extends RemoteClass{
	public Doctorreserve(Activity activity){super(activity);}
	private long id;
	private String doctorplan_fid;
	private String financial_transaction_fid;
	private String presencetype_fid;
	private String reserve_date;
	private String role_systemuser_fid;
	public void getAll(List<Doctorreserve> Doctorreserves){
		try {
			String DeviceID= SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/ocms/doctorreservelist.jsp";
			URL+="?deviceid="+DeviceID;
			JsonReader reader=getReader(URL,false,null);
			if(reader.hasNext()) {
			reader.beginArray(); 
			while (reader.hasNext())
			Doctorreserves.add(getObject(reader));
		reader.endArray();
		}
		return;
		}catch (IOException e) {
		e.printStackTrace();
		}
		return;
	}
	public Doctorreserve getOne(long Id)
	{
		try {
			String DeviceID = SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/ocms/doctorreserve.jsp";
			URL+="?deviceid="+DeviceID+"&id="+String.valueOf(Id);
			JsonReader reader=getReader(URL,false,null);
			return getObject(reader);
		}catch (IOException e) {
		e.printStackTrace();
		}
		return null;
	}
	private Doctorreserve getObject(JsonReader reader) throws IOException {
				reader.beginObject();
				Doctorreserve theDoctorreserve =new Doctorreserve(getActivity());
				while (reader.hasNext()) {
					String key = reader.nextName();
					if (key.equals("id")) {theDoctorreserve.setId(reader.nextInt());}
					else if (key.equals("doctorplan_fid")) {theDoctorreserve.setDoctorplan_fid(reader.nextString());}
					else if (key.equals("financial_transaction_fid")) {theDoctorreserve.setFinancial_transaction_fid(reader.nextString());}
					else if (key.equals("presencetype_fid")) {theDoctorreserve.setPresencetype_fid(reader.nextString());}
					else if (key.equals("reserve_date")) {theDoctorreserve.setReserve_date(reader.nextString());}
					else if (key.equals("role_systemuser_fid")) {theDoctorreserve.setRole_systemuser_fid(reader.nextString());}
				}
			reader.endObject();
				return theDoctorreserve;
	}
	public Message Save()
	{
	try {
			String PageURL=Constants.SITEURL + "json/fa/ocms/managedoctorreserve.jsp";
			String Data = "action=btnSave_Click";
					Data+="&id=" + String.valueOf(id);
					Data+="&doctorplan_fid=" + String.valueOf(doctorplan_fid);
					Data+="&financial_transaction_fid=" + String.valueOf(financial_transaction_fid);
					Data+="&presencetype_fid=" + String.valueOf(presencetype_fid);
					Data+="&reserve_date=" + String.valueOf(reserve_date);
					Data+="&role_systemuser_fid=" + String.valueOf(role_systemuser_fid);
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