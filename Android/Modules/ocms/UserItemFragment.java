package ocms;
import android.os.AsyncTask;
import android.content.Context;
import android.graphics.Typeface;
import android.net.Uri;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import ocms.User;
public class UserItemFragment extends Fragment {
	private OnFragmentInteractionListener mListener;
	private User theUser;
	private TextView lbl_NameContent;
	private TextView lbl_NameCaption;
	private TextView lbl_FamilyContent;
	private TextView lbl_FamilyCaption;
	private TextView lbl_Born_dateContent;
	private TextView lbl_Born_dateCaption;
	private TextView lbl_MobileContent;
	private TextView lbl_MobileCaption;
	private TextView lbl_Device_idContent;
	private TextView lbl_Device_idCaption;
	private TextView lbl_EmailContent;
	private TextView lbl_EmailCaption;
	private TextView lbl_IsmaleContent;
	private TextView lbl_IsmaleCaption;
	public UserItemFragment() {
	}
	@Override
	public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
	super.onViewCreated(view, savedInstanceState);
	Typeface face= Typeface.createFromAsset(getActivity().getAssets(),"fonts/IRANSansMobile.ttf");
	lbl_NameContent=(TextView)getActivity().findViewById(R.id.lbl_name_content);
	lbl_NameCaption=(TextView)getActivity().findViewById(R.id.lbl_name_caption);
	lbl_FamilyContent=(TextView)getActivity().findViewById(R.id.lbl_family_content);
	lbl_FamilyCaption=(TextView)getActivity().findViewById(R.id.lbl_family_caption);
	lbl_Born_dateContent=(TextView)getActivity().findViewById(R.id.lbl_born_date_content);
	lbl_Born_dateCaption=(TextView)getActivity().findViewById(R.id.lbl_born_date_caption);
	lbl_MobileContent=(TextView)getActivity().findViewById(R.id.lbl_mobile_content);
	lbl_MobileCaption=(TextView)getActivity().findViewById(R.id.lbl_mobile_caption);
	lbl_Device_idContent=(TextView)getActivity().findViewById(R.id.lbl_device_id_content);
	lbl_Device_idCaption=(TextView)getActivity().findViewById(R.id.lbl_device_id_caption);
	lbl_EmailContent=(TextView)getActivity().findViewById(R.id.lbl_email_content);
	lbl_EmailCaption=(TextView)getActivity().findViewById(R.id.lbl_email_caption);
	lbl_IsmaleContent=(TextView)getActivity().findViewById(R.id.lbl_ismale_content);
	lbl_IsmaleCaption=(TextView)getActivity().findViewById(R.id.lbl_ismale_caption);
	lbl_NameContent.setTypeface(face);
	lbl_NameCaption.setTypeface(face);
	lbl_FamilyContent.setTypeface(face);
	lbl_FamilyCaption.setTypeface(face);
	lbl_Born_dateContent.setTypeface(face);
	lbl_Born_dateCaption.setTypeface(face);
	lbl_MobileContent.setTypeface(face);
	lbl_MobileCaption.setTypeface(face);
	lbl_Device_idContent.setTypeface(face);
	lbl_Device_idCaption.setTypeface(face);
	lbl_EmailContent.setTypeface(face);
	lbl_EmailCaption.setTypeface(face);
	lbl_IsmaleContent.setTypeface(face);
	lbl_IsmaleCaption.setTypeface(face);
	}
	private void ReloadData()
	{
	lbl_NameContent.setText(theUser.getName());
	lbl_FamilyContent.setText(theUser.getFamily());
	lbl_Born_dateContent.setText(theUser.getBorn_date());
	lbl_MobileContent.setText(theUser.getMobile());
	lbl_Device_idContent.setText(theUser.getDevice_id());
	lbl_EmailContent.setText(theUser.getEmail());
	lbl_IsmaleContent.setText(theUser.getIsmale());
	}        
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        AsyncTask.execute(new Runnable() {
			@Override
			public void run() {
				theUser=new User(getActivity()).getOne(((MainActivity)getActivity()).ItemID);
				getActivity().runOnUiThread(new Runnable() {
					@Override
					public void run() {
						ReloadData();
					}
				});
			}
		});
        View view = inflater.inflate(R.layout.fragment_user_item, container, false);
        return view;
    }
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }
    @Override
    public void onAttach(Context context) {
        super.onAttach(context);
        if (context instanceof OnFragmentInteractionListener) {
            mListener = (OnFragmentInteractionListener) context;
        }
    }
    @Override
    public void onDetach() {
        super.onDetach();
        mListener = null;
    }
    public interface OnFragmentInteractionListener {
        void onFragmentInteraction(Uri uri);
    }
  }