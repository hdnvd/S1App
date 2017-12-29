package sfman;
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
import java.util.ArrayList;
import java.util.List;
import android.app.Activity;
public class Pageinfo extends RemoteClass{
	public Pageinfo(Activity activity){super(activity);}
	private long id;
	private String title;
	private String description;
	private String keywords;
	private String themepage;
	private String internalurl;
	private String canonicalurl;
	private String sentenceinurl;
	public List<Pageinfo> getAll(){
		List<Pageinfo> Pageinfos=new ArrayList<>();
		try {
			String DeviceID= SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/sfman/pageinfolist.jsp";
			URL+="?deviceid="+DeviceID;
			JsonReader reader=getReader(URL);
			if(reader.hasNext()) {
			reader.beginArray(); 
			while (reader.hasNext())
			Pageinfos.add(getObject(reader));
		reader.endArray();
		}
		return Pageinfos;
		}catch (IOException e) {
		e.printStackTrace();
		}
		return null;
	}
	public Pageinfo getOne(long Id)
	{
		try {
			String DeviceID = SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/sfman/pageinfo.jsp";
			URL+="?deviceid="+DeviceID+"&id="+String.valueOf(Id);
			JsonReader reader=getReader(URL);
			return getObject(reader);
		}catch (IOException e) {
		e.printStackTrace();
		}
		return null;
	}
	private Pageinfo getObject(JsonReader reader) throws IOException {
				reader.beginObject();
				Pageinfo thePageinfo =new Pageinfo(getActivity());
				while (reader.hasNext()) {
					String key = reader.nextName();
					if (key.equals("id")) {thePageinfo.setId(reader.nextInt());}
					else if (key.equals("title")) {thePageinfo.setTitle(reader.nextString());}
					else if (key.equals("description")) {thePageinfo.setDescription(reader.nextString());}
					else if (key.equals("keywords")) {thePageinfo.setKeywords(reader.nextString());}
					else if (key.equals("themepage")) {thePageinfo.setThemepage(reader.nextString());}
					else if (key.equals("internalurl")) {thePageinfo.setInternalurl(reader.nextString());}
					else if (key.equals("canonicalurl")) {thePageinfo.setCanonicalurl(reader.nextString());}
					else if (key.equals("sentenceinurl")) {thePageinfo.setSentenceinurl(reader.nextString());}
				}
			reader.endObject();
				return thePageinfo;
	}
}