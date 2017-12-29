package messaging;
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
import messaging.Message;
public class MessageItemFragment extends Fragment {
	private OnFragmentInteractionListener mListener;
	private Message theMessage;
	private TextView lbl_Sender_role_systemuser_fidContent;
	private TextView lbl_Sender_role_systemuser_fidCaption;
	private TextView lbl_Receiver_role_systemuser_fidContent;
	private TextView lbl_Receiver_role_systemuser_fidCaption;
	private TextView lbl_Send_dateContent;
	private TextView lbl_Send_dateCaption;
	private TextView lbl_TitleContent;
	private TextView lbl_TitleCaption;
	private TextView lbl_MessagetextContent;
	private TextView lbl_MessagetextCaption;
	public MessageItemFragment() {
	}
	@Override
	public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
	super.onViewCreated(view, savedInstanceState);
	Typeface face= Typeface.createFromAsset(getActivity().getAssets(),"fonts/IRANSansMobile.ttf");
	lbl_Sender_role_systemuser_fidContent=(TextView)getActivity().findViewById(R.id.lbl_sender_role_systemuser_fid_content);
	lbl_Sender_role_systemuser_fidCaption=(TextView)getActivity().findViewById(R.id.lbl_sender_role_systemuser_fid_caption);
	lbl_Receiver_role_systemuser_fidContent=(TextView)getActivity().findViewById(R.id.lbl_receiver_role_systemuser_fid_content);
	lbl_Receiver_role_systemuser_fidCaption=(TextView)getActivity().findViewById(R.id.lbl_receiver_role_systemuser_fid_caption);
	lbl_Send_dateContent=(TextView)getActivity().findViewById(R.id.lbl_send_date_content);
	lbl_Send_dateCaption=(TextView)getActivity().findViewById(R.id.lbl_send_date_caption);
	lbl_TitleContent=(TextView)getActivity().findViewById(R.id.lbl_title_content);
	lbl_TitleCaption=(TextView)getActivity().findViewById(R.id.lbl_title_caption);
	lbl_MessagetextContent=(TextView)getActivity().findViewById(R.id.lbl_messagetext_content);
	lbl_MessagetextCaption=(TextView)getActivity().findViewById(R.id.lbl_messagetext_caption);
	lbl_Sender_role_systemuser_fidContent.setTypeface(face);
	lbl_Sender_role_systemuser_fidCaption.setTypeface(face);
	lbl_Receiver_role_systemuser_fidContent.setTypeface(face);
	lbl_Receiver_role_systemuser_fidCaption.setTypeface(face);
	lbl_Send_dateContent.setTypeface(face);
	lbl_Send_dateCaption.setTypeface(face);
	lbl_TitleContent.setTypeface(face);
	lbl_TitleCaption.setTypeface(face);
	lbl_MessagetextContent.setTypeface(face);
	lbl_MessagetextCaption.setTypeface(face);
	}
	private void ReloadData()
	{
	lbl_Sender_role_systemuser_fidContent.setText(theMessage.getSender_role_systemuser_fid());
	lbl_Receiver_role_systemuser_fidContent.setText(theMessage.getReceiver_role_systemuser_fid());
	lbl_Send_dateContent.setText(theMessage.getSend_date());
	lbl_TitleContent.setText(theMessage.getTitle());
	lbl_MessagetextContent.setText(theMessage.getMessagetext());
	}        
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        AsyncTask.execute(new Runnable() {
			@Override
			public void run() {
				theMessage=new Message(getActivity()).getOne(((MainActivity)getActivity()).ItemID);
				getActivity().runOnUiThread(new Runnable() {
					@Override
					public void run() {
						ReloadData();
					}
				});
			}
		});
        View view = inflater.inflate(R.layout.fragment_message_item, container, false);
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