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
public class Doctor extends RemoteClass{
	public Doctor(Activity activity){super(activity);}
	private long id;
	private String name;
	private String family;
	private String nezam_code;
	private String mellicode;
	private String mobile;
	private String email;
	private String tel;
	private String ismale;
	private String speciality_fid;
	private String education;
	private String matabtel;
	private String matabaddress;
	private String longitude;
	private String latitude;
	private String common_city_fid;
	private String isactiveonphone;
	private String isactiveonplace;
	private String isactiveonhome;
	private String photo_flu;
	private String role_systemuser_fid;
	public void getAll(List<Doctor> Doctors){
		try {
			String DeviceID= SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/ocms/doctorlist.jsp";
			URL+="?deviceid="+DeviceID;
			JsonReader reader=getReader(URL,false,null);
			if(reader.hasNext()) {
			reader.beginArray(); 
			while (reader.hasNext())
			Doctors.add(getObject(reader));
		reader.endArray();
		}
		return;
		}catch (IOException e) {
		e.printStackTrace();
		}
		return;
	}
	public Doctor getOne(long Id)
	{
		try {
			String DeviceID = SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/ocms/doctor.jsp";
			URL+="?deviceid="+DeviceID+"&id="+String.valueOf(Id);
			JsonReader reader=getReader(URL,false,null);
			return getObject(reader);
		}catch (IOException e) {
		e.printStackTrace();
		}
		return null;
	}
	private Doctor getObject(JsonReader reader) throws IOException {
				reader.beginObject();
				Doctor theDoctor =new Doctor(getActivity());
				while (reader.hasNext()) {
					String key = reader.nextName();
					if (key.equals("id")) {theDoctor.setId(reader.nextInt());}
					else if (key.equals("name")) {theDoctor.setName(reader.nextString());}
					else if (key.equals("family")) {theDoctor.setFamily(reader.nextString());}
					else if (key.equals("nezam_code")) {theDoctor.setNezam_code(reader.nextString());}
					else if (key.equals("mellicode")) {theDoctor.setMellicode(reader.nextString());}
					else if (key.equals("mobile")) {theDoctor.setMobile(reader.nextString());}
					else if (key.equals("email")) {theDoctor.setEmail(reader.nextString());}
					else if (key.equals("tel")) {theDoctor.setTel(reader.nextString());}
					else if (key.equals("ismale")) {theDoctor.setIsmale(reader.nextString());}
					else if (key.equals("speciality_fid")) {theDoctor.setSpeciality_fid(reader.nextString());}
					else if (key.equals("education")) {theDoctor.setEducation(reader.nextString());}
					else if (key.equals("matabtel")) {theDoctor.setMatabtel(reader.nextString());}
					else if (key.equals("matabaddress")) {theDoctor.setMatabaddress(reader.nextString());}
					else if (key.equals("longitude")) {theDoctor.setLongitude(reader.nextString());}
					else if (key.equals("latitude")) {theDoctor.setLatitude(reader.nextString());}
					else if (key.equals("common_city_fid")) {theDoctor.setCommon_city_fid(reader.nextString());}
					else if (key.equals("isactiveonphone")) {theDoctor.setIsactiveonphone(reader.nextString());}
					else if (key.equals("isactiveonplace")) {theDoctor.setIsactiveonplace(reader.nextString());}
					else if (key.equals("isactiveonhome")) {theDoctor.setIsactiveonhome(reader.nextString());}
					else if (key.equals("photo_flu")) {theDoctor.setPhoto_flu(reader.nextString());}
					else if (key.equals("role_systemuser_fid")) {theDoctor.setRole_systemuser_fid(reader.nextString());}
				}
			reader.endObject();
				return theDoctor;
	}
	public Message Save()
	{
	try {
			String PageURL=Constants.SITEURL + "json/fa/ocms/managedoctor.jsp";
			String Data = "action=btnSave_Click";
					Data+="&id=" + String.valueOf(id);
					Data+="&name=" + String.valueOf(name);
					Data+="&family=" + String.valueOf(family);
					Data+="&nezam_code=" + String.valueOf(nezam_code);
					Data+="&mellicode=" + String.valueOf(mellicode);
					Data+="&mobile=" + String.valueOf(mobile);
					Data+="&email=" + String.valueOf(email);
					Data+="&tel=" + String.valueOf(tel);
					Data+="&ismale=" + String.valueOf(ismale);
					Data+="&speciality_fid=" + String.valueOf(speciality_fid);
					Data+="&education=" + String.valueOf(education);
					Data+="&matabtel=" + String.valueOf(matabtel);
					Data+="&matabaddress=" + String.valueOf(matabaddress);
					Data+="&longitude=" + String.valueOf(longitude);
					Data+="&latitude=" + String.valueOf(latitude);
					Data+="&common_city_fid=" + String.valueOf(common_city_fid);
					Data+="&isactiveonphone=" + String.valueOf(isactiveonphone);
					Data+="&isactiveonplace=" + String.valueOf(isactiveonplace);
					Data+="&isactiveonhome=" + String.valueOf(isactiveonhome);
					Data+="&photo_flu=" + String.valueOf(photo_flu);
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