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
public class File extends RemoteClass{
	public File(Activity activity){super(activity);}
	private long id;
	private String file_flu;
	private String title;
	private String thumbnail_flu;
	private String add_date;
	private String description;
	private String price;
	private String filecount;
	private String filetype_fid;
	private String role_systemuser_fid;
	public void getAll(List<File> Files){
		try {
			String DeviceID= SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/fileshop/filelist.jsp";
			URL+="?deviceid="+DeviceID;
			JsonReader reader=getReader(URL,false,null);
			if(reader.hasNext()) {
			reader.beginArray(); 
			while (reader.hasNext())
			Files.add(getObject(reader));
		reader.endArray();
		}
		return;
		}catch (IOException e) {
		e.printStackTrace();
		}
		return;
	}
	public File getOne(long Id)
	{
		try {
			String DeviceID = SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/fileshop/file.jsp";
			URL+="?deviceid="+DeviceID+"&id="+String.valueOf(Id);
			JsonReader reader=getReader(URL,false,null);
			return getObject(reader);
		}catch (IOException e) {
		e.printStackTrace();
		}
		return null;
	}
	private File getObject(JsonReader reader) throws IOException {
				reader.beginObject();
				File theFile =new File(getActivity());
				while (reader.hasNext()) {
					String key = reader.nextName();
					if (key.equals("id")) {theFile.setId(reader.nextInt());}
					else if (key.equals("file_flu")) {theFile.setFile_flu(reader.nextString());}
					else if (key.equals("title")) {theFile.setTitle(reader.nextString());}
					else if (key.equals("thumbnail_flu")) {theFile.setThumbnail_flu(reader.nextString());}
					else if (key.equals("add_date")) {theFile.setAdd_date(reader.nextString());}
					else if (key.equals("description")) {theFile.setDescription(reader.nextString());}
					else if (key.equals("price")) {theFile.setPrice(reader.nextString());}
					else if (key.equals("filecount")) {theFile.setFilecount(reader.nextString());}
					else if (key.equals("filetype_fid")) {theFile.setFiletype_fid(reader.nextString());}
					else if (key.equals("role_systemuser_fid")) {theFile.setRole_systemuser_fid(reader.nextString());}
				}
			reader.endObject();
				return theFile;
	}
	public Message Save()
	{
	try {
			String PageURL=Constants.SITEURL + "json/fa/fileshop/managefile.jsp";
			String Data = "action=btnSave_Click";
					Data+="&id=" + String.valueOf(id);
					Data+="&file_flu=" + String.valueOf(file_flu);
					Data+="&title=" + String.valueOf(title);
					Data+="&thumbnail_flu=" + String.valueOf(thumbnail_flu);
					Data+="&add_date=" + String.valueOf(add_date);
					Data+="&description=" + String.valueOf(description);
					Data+="&price=" + String.valueOf(price);
					Data+="&filecount=" + String.valueOf(filecount);
					Data+="&filetype_fid=" + String.valueOf(filetype_fid);
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