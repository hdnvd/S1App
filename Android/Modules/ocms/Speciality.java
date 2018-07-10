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
public class Speciality extends RemoteClass{
	public Speciality(Activity activity){super(activity);}
	private long id;
	private String title;
	private String speciality_fid;
	public void getAll(List<Speciality> Specialitys){
		try {
			String DeviceID= SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/ocms/specialitylist.jsp";
			URL+="?deviceid="+DeviceID;
			JsonReader reader=getReader(URL,false,null);
			if(reader.hasNext()) {
			reader.beginArray(); 
			while (reader.hasNext())
			Specialitys.add(getObject(reader));
		reader.endArray();
		}
		return;
		}catch (IOException e) {
		e.printStackTrace();
		}
		return;
	}
	public Speciality getOne(long Id)
	{
		try {
			String DeviceID = SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/ocms/speciality.jsp";
			URL+="?deviceid="+DeviceID+"&id="+String.valueOf(Id);
			JsonReader reader=getReader(URL,false,null);
			return getObject(reader);
		}catch (IOException e) {
		e.printStackTrace();
		}
		return null;
	}
	private Speciality getObject(JsonReader reader) throws IOException {
				reader.beginObject();
				Speciality theSpeciality =new Speciality(getActivity());
				while (reader.hasNext()) {
					String key = reader.nextName();
					if (key.equals("id")) {theSpeciality.setId(reader.nextInt());}
					else if (key.equals("title")) {theSpeciality.setTitle(reader.nextString());}
					else if (key.equals("speciality_fid")) {theSpeciality.setSpeciality_fid(reader.nextString());}
				}
			reader.endObject();
				return theSpeciality;
	}
	public Message Save()
	{
	try {
			String PageURL=Constants.SITEURL + "json/fa/ocms/managespeciality.jsp";
			String Data = "action=btnSave_Click";
					Data+="&id=" + String.valueOf(id);
					Data+="&title=" + String.valueOf(title);
					Data+="&speciality_fid=" + String.valueOf(speciality_fid);
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