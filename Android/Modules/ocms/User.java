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
public class User extends RemoteClass{
	public User(Activity activity){super(activity);}
	private long id;
	private String name;
	private String family;
	private String born_date;
	private String mobile;
	private String device_id;
	private String email;
	private String ismale;
	public void getAll(List<User> Users){
		try {
			String DeviceID= SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/ocms/userlist.jsp";
			URL+="?deviceid="+DeviceID;
			JsonReader reader=getReader(URL,false,null);
			if(reader.hasNext()) {
			reader.beginArray(); 
			while (reader.hasNext())
			Users.add(getObject(reader));
		reader.endArray();
		}
		return;
		}catch (IOException e) {
		e.printStackTrace();
		}
		return;
	}
	public User getOne(long Id)
	{
		try {
			String DeviceID = SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/ocms/user.jsp";
			URL+="?deviceid="+DeviceID+"&id="+String.valueOf(Id);
			JsonReader reader=getReader(URL,false,null);
			return getObject(reader);
		}catch (IOException e) {
		e.printStackTrace();
		}
		return null;
	}
	private User getObject(JsonReader reader) throws IOException {
				reader.beginObject();
				User theUser =new User(getActivity());
				while (reader.hasNext()) {
					String key = reader.nextName();
					if (key.equals("id")) {theUser.setId(reader.nextInt());}
					else if (key.equals("name")) {theUser.setName(reader.nextString());}
					else if (key.equals("family")) {theUser.setFamily(reader.nextString());}
					else if (key.equals("born_date")) {theUser.setBorn_date(reader.nextString());}
					else if (key.equals("mobile")) {theUser.setMobile(reader.nextString());}
					else if (key.equals("device_id")) {theUser.setDevice_id(reader.nextString());}
					else if (key.equals("email")) {theUser.setEmail(reader.nextString());}
					else if (key.equals("ismale")) {theUser.setIsmale(reader.nextString());}
				}
			reader.endObject();
				return theUser;
	}
	public Message Save()
	{
	try {
			String PageURL=Constants.SITEURL + "json/fa/ocms/manageuser.jsp";
			String Data = "action=btnSave_Click";
					Data+="&id=" + String.valueOf(id);
					Data+="&name=" + String.valueOf(name);
					Data+="&family=" + String.valueOf(family);
					Data+="&born_date=" + String.valueOf(born_date);
					Data+="&mobile=" + String.valueOf(mobile);
					Data+="&device_id=" + String.valueOf(device_id);
					Data+="&email=" + String.valueOf(email);
					Data+="&ismale=" + String.valueOf(ismale);
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