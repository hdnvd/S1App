package messaging;
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
public class Message extends RemoteClass{
	public Message(Activity activity){super(activity);}
	private long id;
	private String sender_role_systemuser_fid;
	private String receiver_role_systemuser_fid;
	private String send_date;
	private String title;
	private String messagetext;
	public void getAll(List<Message> Messages){
		try {
			String DeviceID= SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/messaging/messagelist.jsp";
			URL+="?deviceid="+DeviceID;
			JsonReader reader=getReader(URL,false,null);
			if(reader.hasNext()) {
			reader.beginArray(); 
			while (reader.hasNext())
			Messages.add(getObject(reader));
		reader.endArray();
		}
		return;
		}catch (IOException e) {
		e.printStackTrace();
		}
		return;
	}
	public Message getOne(long Id)
	{
		try {
			String DeviceID = SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/messaging/message.jsp";
			URL+="?deviceid="+DeviceID+"&id="+String.valueOf(Id);
			JsonReader reader=getReader(URL,false,null);
			return getObject(reader);
		}catch (IOException e) {
		e.printStackTrace();
		}
		return null;
	}
	private Message getObject(JsonReader reader) throws IOException {
				reader.beginObject();
				Message theMessage =new Message(getActivity());
				while (reader.hasNext()) {
					String key = reader.nextName();
					if (key.equals("id")) {theMessage.setId(reader.nextInt());}
					else if (key.equals("sender_role_systemuser_fid")) {theMessage.setSender_role_systemuser_fid(reader.nextString());}
					else if (key.equals("receiver_role_systemuser_fid")) {theMessage.setReceiver_role_systemuser_fid(reader.nextString());}
					else if (key.equals("send_date")) {theMessage.setSend_date(reader.nextString());}
					else if (key.equals("title")) {theMessage.setTitle(reader.nextString());}
					else if (key.equals("messagetext")) {theMessage.setMessagetext(reader.nextString());}
				}
			reader.endObject();
				return theMessage;
	}
	public Message Save()
	{
	try {
			String PageURL=Constants.SITEURL + "json/fa/messaging/managemessage.jsp";
			String Data = "action=btnSave_Click";
					Data+="&id=" + String.valueOf(id);
					Data+="&sender_role_systemuser_fid=" + String.valueOf(sender_role_systemuser_fid);
					Data+="&receiver_role_systemuser_fid=" + String.valueOf(receiver_role_systemuser_fid);
					Data+="&send_date=" + String.valueOf(send_date);
					Data+="&title=" + String.valueOf(title);
					Data+="&messagetext=" + String.valueOf(messagetext);
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