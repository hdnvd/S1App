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
import ocms.Doctorreserve;
public class DoctorreserveItemFragment extends Fragment {
	private OnFragmentInteractionListener mListener;
	private Doctorreserve theDoctorreserve;
	private TextView lbl_Doctorplan_fidContent;
	private TextView lbl_Doctorplan_fidCaption;
	private TextView lbl_Financial_transaction_fidContent;
	private TextView lbl_Financial_transaction_fidCaption;
	private TextView lbl_Presencetype_fidContent;
	private TextView lbl_Presencetype_fidCaption;
	private TextView lbl_Reserve_dateContent;
	private TextView lbl_Reserve_dateCaption;
	private TextView lbl_Role_systemuser_fidContent;
	private TextView lbl_Role_systemuser_fidCaption;
	public DoctorreserveItemFragment() {
	}
	@Override
	public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
	super.onViewCreated(view, savedInstanceState);
	Typeface face= Typeface.createFromAsset(getActivity().getAssets(),"fonts/IRANSansMobile.ttf");
	lbl_Doctorplan_fidContent=(TextView)getActivity().findViewById(R.id.lbl_doctorplan_fid_content);
	lbl_Doctorplan_fidCaption=(TextView)getActivity().findViewById(R.id.lbl_doctorplan_fid_caption);
	lbl_Financial_transaction_fidContent=(TextView)getActivity().findViewById(R.id.lbl_financial_transaction_fid_content);
	lbl_Financial_transaction_fidCaption=(TextView)getActivity().findViewById(R.id.lbl_financial_transaction_fid_caption);
	lbl_Presencetype_fidContent=(TextView)getActivity().findViewById(R.id.lbl_presencetype_fid_content);
	lbl_Presencetype_fidCaption=(TextView)getActivity().findViewById(R.id.lbl_presencetype_fid_caption);
	lbl_Reserve_dateContent=(TextView)getActivity().findViewById(R.id.lbl_reserve_date_content);
	lbl_Reserve_dateCaption=(TextView)getActivity().findViewById(R.id.lbl_reserve_date_caption);
	lbl_Role_systemuser_fidContent=(TextView)getActivity().findViewById(R.id.lbl_role_systemuser_fid_content);
	lbl_Role_systemuser_fidCaption=(TextView)getActivity().findViewById(R.id.lbl_role_systemuser_fid_caption);
	lbl_Doctorplan_fidContent.setTypeface(face);
	lbl_Doctorplan_fidCaption.setTypeface(face);
	lbl_Financial_transaction_fidContent.setTypeface(face);
	lbl_Financial_transaction_fidCaption.setTypeface(face);
	lbl_Presencetype_fidContent.setTypeface(face);
	lbl_Presencetype_fidCaption.setTypeface(face);
	lbl_Reserve_dateContent.setTypeface(face);
	lbl_Reserve_dateCaption.setTypeface(face);
	lbl_Role_systemuser_fidContent.setTypeface(face);
	lbl_Role_systemuser_fidCaption.setTypeface(face);
	}
	private void ReloadData()
	{
	lbl_Doctorplan_fidContent.setText(theDoctorreserve.getDoctorplan_fid());
	lbl_Financial_transaction_fidContent.setText(theDoctorreserve.getFinancial_transaction_fid());
	lbl_Presencetype_fidContent.setText(theDoctorreserve.getPresencetype_fid());
	lbl_Reserve_dateContent.setText(theDoctorreserve.getReserve_date());
	lbl_Role_systemuser_fidContent.setText(theDoctorreserve.getRole_systemuser_fid());
	}        
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        AsyncTask.execute(new Runnable() {
			@Override
			public void run() {
				theDoctorreserve=new Doctorreserve(getActivity()).getOne(((MainActivity)getActivity()).ItemID);
				getActivity().runOnUiThread(new Runnable() {
					@Override
					public void run() {
						ReloadData();
					}
				});
			}
		});
        View view = inflater.inflate(R.layout.fragment_doctorreserve_item, container, false);
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