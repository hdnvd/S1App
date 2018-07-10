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
import ocms.Speciality;
public class SpecialityItemFragment extends Fragment {
	private OnFragmentInteractionListener mListener;
	private Speciality theSpeciality;
	private TextView lbl_TitleContent;
	private TextView lbl_TitleCaption;
	private TextView lbl_Speciality_fidContent;
	private TextView lbl_Speciality_fidCaption;
	public SpecialityItemFragment() {
	}
	@Override
	public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
	super.onViewCreated(view, savedInstanceState);
	Typeface face= Typeface.createFromAsset(getActivity().getAssets(),"fonts/IRANSansMobile.ttf");
	lbl_TitleContent=(TextView)getActivity().findViewById(R.id.lbl_title_content);
	lbl_TitleCaption=(TextView)getActivity().findViewById(R.id.lbl_title_caption);
	lbl_Speciality_fidContent=(TextView)getActivity().findViewById(R.id.lbl_speciality_fid_content);
	lbl_Speciality_fidCaption=(TextView)getActivity().findViewById(R.id.lbl_speciality_fid_caption);
	lbl_TitleContent.setTypeface(face);
	lbl_TitleCaption.setTypeface(face);
	lbl_Speciality_fidContent.setTypeface(face);
	lbl_Speciality_fidCaption.setTypeface(face);
	}
	private void ReloadData()
	{
	lbl_TitleContent.setText(theSpeciality.getTitle());
	lbl_Speciality_fidContent.setText(theSpeciality.getSpeciality_fid());
	}        
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        AsyncTask.execute(new Runnable() {
			@Override
			public void run() {
				theSpeciality=new Speciality(getActivity()).getOne(((MainActivity)getActivity()).ItemID);
				getActivity().runOnUiThread(new Runnable() {
					@Override
					public void run() {
						ReloadData();
					}
				});
			}
		});
        View view = inflater.inflate(R.layout.fragment_speciality_item, container, false);
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