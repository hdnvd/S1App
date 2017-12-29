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
import ocms.Doctorplan;
public class DoctorplanItemFragment extends Fragment {
	private OnFragmentInteractionListener mListener;
	private Doctorplan theDoctorplan;
	private TextView lbl_Start_timeContent;
	private TextView lbl_Start_timeCaption;
	private TextView lbl_End_timeContent;
	private TextView lbl_End_timeCaption;
	private TextView lbl_Doctor_fidContent;
	private TextView lbl_Doctor_fidCaption;
	public DoctorplanItemFragment() {
	}
	@Override
	public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
	super.onViewCreated(view, savedInstanceState);
	Typeface face= Typeface.createFromAsset(getActivity().getAssets(),"fonts/IRANSansMobile.ttf");
	lbl_Start_timeContent=(TextView)getActivity().findViewById(R.id.lbl_start_time_content);
	lbl_Start_timeCaption=(TextView)getActivity().findViewById(R.id.lbl_start_time_caption);
	lbl_End_timeContent=(TextView)getActivity().findViewById(R.id.lbl_end_time_content);
	lbl_End_timeCaption=(TextView)getActivity().findViewById(R.id.lbl_end_time_caption);
	lbl_Doctor_fidContent=(TextView)getActivity().findViewById(R.id.lbl_doctor_fid_content);
	lbl_Doctor_fidCaption=(TextView)getActivity().findViewById(R.id.lbl_doctor_fid_caption);
	lbl_Start_timeContent.setTypeface(face);
	lbl_Start_timeCaption.setTypeface(face);
	lbl_End_timeContent.setTypeface(face);
	lbl_End_timeCaption.setTypeface(face);
	lbl_Doctor_fidContent.setTypeface(face);
	lbl_Doctor_fidCaption.setTypeface(face);
	}
	private void ReloadData()
	{
	lbl_Start_timeContent.setText(theDoctorplan.getStart_time());
	lbl_End_timeContent.setText(theDoctorplan.getEnd_time());
	lbl_Doctor_fidContent.setText(theDoctorplan.getDoctor_fid());
	}        
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        AsyncTask.execute(new Runnable() {
			@Override
			public void run() {
				theDoctorplan=new Doctorplan(getActivity()).getOne(((MainActivity)getActivity()).ItemID);
				getActivity().runOnUiThread(new Runnable() {
					@Override
					public void run() {
						ReloadData();
					}
				});
			}
		});
        View view = inflater.inflate(R.layout.fragment_doctorplan_item, container, false);
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