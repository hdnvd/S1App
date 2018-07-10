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
import ocms.Doctor;
public class DoctorItemFragment extends Fragment {
	private OnFragmentInteractionListener mListener;
	private Doctor theDoctor;
	private TextView lbl_NameContent;
	private TextView lbl_NameCaption;
	private TextView lbl_FamilyContent;
	private TextView lbl_FamilyCaption;
	private TextView lbl_Nezam_codeContent;
	private TextView lbl_Nezam_codeCaption;
	private TextView lbl_MellicodeContent;
	private TextView lbl_MellicodeCaption;
	private TextView lbl_MobileContent;
	private TextView lbl_MobileCaption;
	private TextView lbl_EmailContent;
	private TextView lbl_EmailCaption;
	private TextView lbl_TelContent;
	private TextView lbl_TelCaption;
	private TextView lbl_IsmaleContent;
	private TextView lbl_IsmaleCaption;
	private TextView lbl_Speciality_fidContent;
	private TextView lbl_Speciality_fidCaption;
	private TextView lbl_EducationContent;
	private TextView lbl_EducationCaption;
	private TextView lbl_MatabtelContent;
	private TextView lbl_MatabtelCaption;
	private TextView lbl_MatabaddressContent;
	private TextView lbl_MatabaddressCaption;
	private TextView lbl_LongitudeContent;
	private TextView lbl_LongitudeCaption;
	private TextView lbl_LatitudeContent;
	private TextView lbl_LatitudeCaption;
	private TextView lbl_Common_city_fidContent;
	private TextView lbl_Common_city_fidCaption;
	private TextView lbl_IsactiveonphoneContent;
	private TextView lbl_IsactiveonphoneCaption;
	private TextView lbl_IsactiveonplaceContent;
	private TextView lbl_IsactiveonplaceCaption;
	private TextView lbl_IsactiveonhomeContent;
	private TextView lbl_IsactiveonhomeCaption;
	private TextView lbl_Photo_fluContent;
	private TextView lbl_Photo_fluCaption;
	private TextView lbl_Role_systemuser_fidContent;
	private TextView lbl_Role_systemuser_fidCaption;
	public DoctorItemFragment() {
	}
	@Override
	public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
	super.onViewCreated(view, savedInstanceState);
	Typeface face= Typeface.createFromAsset(getActivity().getAssets(),"fonts/IRANSansMobile.ttf");
	lbl_NameContent=(TextView)getActivity().findViewById(R.id.lbl_name_content);
	lbl_NameCaption=(TextView)getActivity().findViewById(R.id.lbl_name_caption);
	lbl_FamilyContent=(TextView)getActivity().findViewById(R.id.lbl_family_content);
	lbl_FamilyCaption=(TextView)getActivity().findViewById(R.id.lbl_family_caption);
	lbl_Nezam_codeContent=(TextView)getActivity().findViewById(R.id.lbl_nezam_code_content);
	lbl_Nezam_codeCaption=(TextView)getActivity().findViewById(R.id.lbl_nezam_code_caption);
	lbl_MellicodeContent=(TextView)getActivity().findViewById(R.id.lbl_mellicode_content);
	lbl_MellicodeCaption=(TextView)getActivity().findViewById(R.id.lbl_mellicode_caption);
	lbl_MobileContent=(TextView)getActivity().findViewById(R.id.lbl_mobile_content);
	lbl_MobileCaption=(TextView)getActivity().findViewById(R.id.lbl_mobile_caption);
	lbl_EmailContent=(TextView)getActivity().findViewById(R.id.lbl_email_content);
	lbl_EmailCaption=(TextView)getActivity().findViewById(R.id.lbl_email_caption);
	lbl_TelContent=(TextView)getActivity().findViewById(R.id.lbl_tel_content);
	lbl_TelCaption=(TextView)getActivity().findViewById(R.id.lbl_tel_caption);
	lbl_IsmaleContent=(TextView)getActivity().findViewById(R.id.lbl_ismale_content);
	lbl_IsmaleCaption=(TextView)getActivity().findViewById(R.id.lbl_ismale_caption);
	lbl_Speciality_fidContent=(TextView)getActivity().findViewById(R.id.lbl_speciality_fid_content);
	lbl_Speciality_fidCaption=(TextView)getActivity().findViewById(R.id.lbl_speciality_fid_caption);
	lbl_EducationContent=(TextView)getActivity().findViewById(R.id.lbl_education_content);
	lbl_EducationCaption=(TextView)getActivity().findViewById(R.id.lbl_education_caption);
	lbl_MatabtelContent=(TextView)getActivity().findViewById(R.id.lbl_matabtel_content);
	lbl_MatabtelCaption=(TextView)getActivity().findViewById(R.id.lbl_matabtel_caption);
	lbl_MatabaddressContent=(TextView)getActivity().findViewById(R.id.lbl_matabaddress_content);
	lbl_MatabaddressCaption=(TextView)getActivity().findViewById(R.id.lbl_matabaddress_caption);
	lbl_LongitudeContent=(TextView)getActivity().findViewById(R.id.lbl_longitude_content);
	lbl_LongitudeCaption=(TextView)getActivity().findViewById(R.id.lbl_longitude_caption);
	lbl_LatitudeContent=(TextView)getActivity().findViewById(R.id.lbl_latitude_content);
	lbl_LatitudeCaption=(TextView)getActivity().findViewById(R.id.lbl_latitude_caption);
	lbl_Common_city_fidContent=(TextView)getActivity().findViewById(R.id.lbl_common_city_fid_content);
	lbl_Common_city_fidCaption=(TextView)getActivity().findViewById(R.id.lbl_common_city_fid_caption);
	lbl_IsactiveonphoneContent=(TextView)getActivity().findViewById(R.id.lbl_isactiveonphone_content);
	lbl_IsactiveonphoneCaption=(TextView)getActivity().findViewById(R.id.lbl_isactiveonphone_caption);
	lbl_IsactiveonplaceContent=(TextView)getActivity().findViewById(R.id.lbl_isactiveonplace_content);
	lbl_IsactiveonplaceCaption=(TextView)getActivity().findViewById(R.id.lbl_isactiveonplace_caption);
	lbl_IsactiveonhomeContent=(TextView)getActivity().findViewById(R.id.lbl_isactiveonhome_content);
	lbl_IsactiveonhomeCaption=(TextView)getActivity().findViewById(R.id.lbl_isactiveonhome_caption);
	lbl_Photo_fluContent=(TextView)getActivity().findViewById(R.id.lbl_photo_flu_content);
	lbl_Photo_fluCaption=(TextView)getActivity().findViewById(R.id.lbl_photo_flu_caption);
	lbl_Role_systemuser_fidContent=(TextView)getActivity().findViewById(R.id.lbl_role_systemuser_fid_content);
	lbl_Role_systemuser_fidCaption=(TextView)getActivity().findViewById(R.id.lbl_role_systemuser_fid_caption);
	lbl_NameContent.setTypeface(face);
	lbl_NameCaption.setTypeface(face);
	lbl_FamilyContent.setTypeface(face);
	lbl_FamilyCaption.setTypeface(face);
	lbl_Nezam_codeContent.setTypeface(face);
	lbl_Nezam_codeCaption.setTypeface(face);
	lbl_MellicodeContent.setTypeface(face);
	lbl_MellicodeCaption.setTypeface(face);
	lbl_MobileContent.setTypeface(face);
	lbl_MobileCaption.setTypeface(face);
	lbl_EmailContent.setTypeface(face);
	lbl_EmailCaption.setTypeface(face);
	lbl_TelContent.setTypeface(face);
	lbl_TelCaption.setTypeface(face);
	lbl_IsmaleContent.setTypeface(face);
	lbl_IsmaleCaption.setTypeface(face);
	lbl_Speciality_fidContent.setTypeface(face);
	lbl_Speciality_fidCaption.setTypeface(face);
	lbl_EducationContent.setTypeface(face);
	lbl_EducationCaption.setTypeface(face);
	lbl_MatabtelContent.setTypeface(face);
	lbl_MatabtelCaption.setTypeface(face);
	lbl_MatabaddressContent.setTypeface(face);
	lbl_MatabaddressCaption.setTypeface(face);
	lbl_LongitudeContent.setTypeface(face);
	lbl_LongitudeCaption.setTypeface(face);
	lbl_LatitudeContent.setTypeface(face);
	lbl_LatitudeCaption.setTypeface(face);
	lbl_Common_city_fidContent.setTypeface(face);
	lbl_Common_city_fidCaption.setTypeface(face);
	lbl_IsactiveonphoneContent.setTypeface(face);
	lbl_IsactiveonphoneCaption.setTypeface(face);
	lbl_IsactiveonplaceContent.setTypeface(face);
	lbl_IsactiveonplaceCaption.setTypeface(face);
	lbl_IsactiveonhomeContent.setTypeface(face);
	lbl_IsactiveonhomeCaption.setTypeface(face);
	lbl_Photo_fluContent.setTypeface(face);
	lbl_Photo_fluCaption.setTypeface(face);
	lbl_Role_systemuser_fidContent.setTypeface(face);
	lbl_Role_systemuser_fidCaption.setTypeface(face);
	}
	private void ReloadData()
	{
	lbl_NameContent.setText(theDoctor.getName());
	lbl_FamilyContent.setText(theDoctor.getFamily());
	lbl_Nezam_codeContent.setText(theDoctor.getNezam_code());
	lbl_MellicodeContent.setText(theDoctor.getMellicode());
	lbl_MobileContent.setText(theDoctor.getMobile());
	lbl_EmailContent.setText(theDoctor.getEmail());
	lbl_TelContent.setText(theDoctor.getTel());
	lbl_IsmaleContent.setText(theDoctor.getIsmale());
	lbl_Speciality_fidContent.setText(theDoctor.getSpeciality_fid());
	lbl_EducationContent.setText(theDoctor.getEducation());
	lbl_MatabtelContent.setText(theDoctor.getMatabtel());
	lbl_MatabaddressContent.setText(theDoctor.getMatabaddress());
	lbl_LongitudeContent.setText(theDoctor.getLongitude());
	lbl_LatitudeContent.setText(theDoctor.getLatitude());
	lbl_Common_city_fidContent.setText(theDoctor.getCommon_city_fid());
	lbl_IsactiveonphoneContent.setText(theDoctor.getIsactiveonphone());
	lbl_IsactiveonplaceContent.setText(theDoctor.getIsactiveonplace());
	lbl_IsactiveonhomeContent.setText(theDoctor.getIsactiveonhome());
	lbl_Photo_fluContent.setText(theDoctor.getPhoto_flu());
	lbl_Role_systemuser_fidContent.setText(theDoctor.getRole_systemuser_fid());
	}        
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        AsyncTask.execute(new Runnable() {
			@Override
			public void run() {
				theDoctor=new Doctor(getActivity()).getOne(((MainActivity)getActivity()).ItemID);
				getActivity().runOnUiThread(new Runnable() {
					@Override
					public void run() {
						ReloadData();
					}
				});
			}
		});
        View view = inflater.inflate(R.layout.fragment_doctor_item, container, false);
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