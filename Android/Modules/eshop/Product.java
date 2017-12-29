package eshop;
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
public class Product extends RemoteClass{
	public Product(Activity activity){super(activity);}
	private long id;
	private String title;
	private String latintitle;
	private String description;
	private String pic1_flu;
	private String pic2_flu;
	private String pic3_flu;
	private String pic4_flu;
	private String price;
	private String code;
	private String adddate;
	private String visitcount;
	private String is_exists;
	public void getAll(List<Product> Products){
		try {
			String DeviceID= SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/eshop/productlist.jsp";
			URL+="?deviceid="+DeviceID;
			JsonReader reader=getReader(URL,false,null);
			if(reader.hasNext()) {
			reader.beginArray(); 
			while (reader.hasNext())
			Products.add(getObject(reader));
		reader.endArray();
		}
		return;
		}catch (IOException e) {
		e.printStackTrace();
		}
		return;
	}
	public Product getOne(long Id)
	{
		try {
			String DeviceID = SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());
			String URL=Constants.SITEURL + "json/fa/eshop/product.jsp";
			URL+="?deviceid="+DeviceID+"&id="+String.valueOf(Id);
			JsonReader reader=getReader(URL,false,null);
			return getObject(reader);
		}catch (IOException e) {
		e.printStackTrace();
		}
		return null;
	}
	private Product getObject(JsonReader reader) throws IOException {
				reader.beginObject();
				Product theProduct =new Product(getActivity());
				while (reader.hasNext()) {
					String key = reader.nextName();
					if (key.equals("id")) {theProduct.setId(reader.nextInt());}
					else if (key.equals("title")) {theProduct.setTitle(reader.nextString());}
					else if (key.equals("latintitle")) {theProduct.setLatintitle(reader.nextString());}
					else if (key.equals("description")) {theProduct.setDescription(reader.nextString());}
					else if (key.equals("pic1_flu")) {theProduct.setPic1_flu(reader.nextString());}
					else if (key.equals("pic2_flu")) {theProduct.setPic2_flu(reader.nextString());}
					else if (key.equals("pic3_flu")) {theProduct.setPic3_flu(reader.nextString());}
					else if (key.equals("pic4_flu")) {theProduct.setPic4_flu(reader.nextString());}
					else if (key.equals("price")) {theProduct.setPrice(reader.nextString());}
					else if (key.equals("code")) {theProduct.setCode(reader.nextString());}
					else if (key.equals("adddate")) {theProduct.setAdddate(reader.nextString());}
					else if (key.equals("visitcount")) {theProduct.setVisitcount(reader.nextString());}
					else if (key.equals("is_exists")) {theProduct.setIs_exists(reader.nextString());}
				}
			reader.endObject();
				return theProduct;
	}
	public Message Save()
	{
	try {
			String PageURL=Constants.SITEURL + "json/fa/eshop/manageproduct.jsp";
			String Data = "action=btnSave_Click";
					Data+="&id=" + String.valueOf(id);
					Data+="&title=" + String.valueOf(title);
					Data+="&latintitle=" + String.valueOf(latintitle);
					Data+="&description=" + String.valueOf(description);
					Data+="&pic1_flu=" + String.valueOf(pic1_flu);
					Data+="&pic2_flu=" + String.valueOf(pic2_flu);
					Data+="&pic3_flu=" + String.valueOf(pic3_flu);
					Data+="&pic4_flu=" + String.valueOf(pic4_flu);
					Data+="&price=" + String.valueOf(price);
					Data+="&code=" + String.valueOf(code);
					Data+="&adddate=" + String.valueOf(adddate);
					Data+="&visitcount=" + String.valueOf(visitcount);
					Data+="&is_exists=" + String.valueOf(is_exists);
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