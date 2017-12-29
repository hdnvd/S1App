package fileshop;
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
import fileshop.Filetransaction;
public class FiletransactionItemFragment extends Fragment {
	private OnFragmentInteractionListener mListener;
	private Filetransaction theFiletransaction;
	private TextView lbl_File_fidContent;
	private TextView lbl_File_fidCaption;
	private TextView lbl_Finance_bankpaymentinfo_fidContent;
	private TextView lbl_Finance_bankpaymentinfo_fidCaption;
	public FiletransactionItemFragment() {
	}
	@Override
	public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
	super.onViewCreated(view, savedInstanceState);
	Typeface face= Typeface.createFromAsset(getActivity().getAssets(),"fonts/IRANSansMobile.ttf");
	lbl_File_fidContent=(TextView)getActivity().findViewById(R.id.lbl_file_fid_content);
	lbl_File_fidCaption=(TextView)getActivity().findViewById(R.id.lbl_file_fid_caption);
	lbl_Finance_bankpaymentinfo_fidContent=(TextView)getActivity().findViewById(R.id.lbl_finance_bankpaymentinfo_fid_content);
	lbl_Finance_bankpaymentinfo_fidCaption=(TextView)getActivity().findViewById(R.id.lbl_finance_bankpaymentinfo_fid_caption);
	lbl_File_fidContent.setTypeface(face);
	lbl_File_fidCaption.setTypeface(face);
	lbl_Finance_bankpaymentinfo_fidContent.setTypeface(face);
	lbl_Finance_bankpaymentinfo_fidCaption.setTypeface(face);
	}
	private void ReloadData()
	{
	lbl_File_fidContent.setText(theFiletransaction.getFile_fid());
	lbl_Finance_bankpaymentinfo_fidContent.setText(theFiletransaction.getFinance_bankpaymentinfo_fid());
	}        
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        AsyncTask.execute(new Runnable() {
			@Override
			public void run() {
				theFiletransaction=new Filetransaction(getActivity()).getOne(((MainActivity)getActivity()).ItemID);
				getActivity().runOnUiThread(new Runnable() {
					@Override
					public void run() {
						ReloadData();
					}
				});
			}
		});
        View view = inflater.inflate(R.layout.fragment_filetransaction_item, container, false);
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