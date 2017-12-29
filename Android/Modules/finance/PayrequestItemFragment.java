package finance;
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
import finance.Payrequest;
public class PayrequestItemFragment extends Fragment {
	private OnFragmentInteractionListener mListener;
	private Payrequest thePayrequest;
	private TextView lbl_Role_systemuser_fidContent;
	private TextView lbl_Role_systemuser_fidCaption;
	private TextView lbl_Request_dateContent;
	private TextView lbl_Request_dateCaption;
	private TextView lbl_PriceContent;
	private TextView lbl_PriceCaption;
	private TextView lbl_Commit_dateContent;
	private TextView lbl_Commit_dateCaption;
	private TextView lbl_Committype_fidContent;
	private TextView lbl_Committype_fidCaption;
	public PayrequestItemFragment() {
	}
	@Override
	public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
	super.onViewCreated(view, savedInstanceState);
	Typeface face= Typeface.createFromAsset(getActivity().getAssets(),"fonts/IRANSansMobile.ttf");
	lbl_Role_systemuser_fidContent=(TextView)getActivity().findViewById(R.id.lbl_role_systemuser_fid_content);
	lbl_Role_systemuser_fidCaption=(TextView)getActivity().findViewById(R.id.lbl_role_systemuser_fid_caption);
	lbl_Request_dateContent=(TextView)getActivity().findViewById(R.id.lbl_request_date_content);
	lbl_Request_dateCaption=(TextView)getActivity().findViewById(R.id.lbl_request_date_caption);
	lbl_PriceContent=(TextView)getActivity().findViewById(R.id.lbl_price_content);
	lbl_PriceCaption=(TextView)getActivity().findViewById(R.id.lbl_price_caption);
	lbl_Commit_dateContent=(TextView)getActivity().findViewById(R.id.lbl_commit_date_content);
	lbl_Commit_dateCaption=(TextView)getActivity().findViewById(R.id.lbl_commit_date_caption);
	lbl_Committype_fidContent=(TextView)getActivity().findViewById(R.id.lbl_committype_fid_content);
	lbl_Committype_fidCaption=(TextView)getActivity().findViewById(R.id.lbl_committype_fid_caption);
	lbl_Role_systemuser_fidContent.setTypeface(face);
	lbl_Role_systemuser_fidCaption.setTypeface(face);
	lbl_Request_dateContent.setTypeface(face);
	lbl_Request_dateCaption.setTypeface(face);
	lbl_PriceContent.setTypeface(face);
	lbl_PriceCaption.setTypeface(face);
	lbl_Commit_dateContent.setTypeface(face);
	lbl_Commit_dateCaption.setTypeface(face);
	lbl_Committype_fidContent.setTypeface(face);
	lbl_Committype_fidCaption.setTypeface(face);
	}
	private void ReloadData()
	{
	lbl_Role_systemuser_fidContent.setText(thePayrequest.getRole_systemuser_fid());
	lbl_Request_dateContent.setText(thePayrequest.getRequest_date());
	lbl_PriceContent.setText(thePayrequest.getPrice());
	lbl_Commit_dateContent.setText(thePayrequest.getCommit_date());
	lbl_Committype_fidContent.setText(thePayrequest.getCommittype_fid());
	}        
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        AsyncTask.execute(new Runnable() {
			@Override
			public void run() {
				thePayrequest=new Payrequest(getActivity()).getOne(((MainActivity)getActivity()).ItemID);
				getActivity().runOnUiThread(new Runnable() {
					@Override
					public void run() {
						ReloadData();
					}
				});
			}
		});
        View view = inflater.inflate(R.layout.fragment_payrequest_item, container, false);
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