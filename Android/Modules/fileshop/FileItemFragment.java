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
import fileshop.File;
public class FileItemFragment extends Fragment {
	private OnFragmentInteractionListener mListener;
	private File theFile;
	private TextView lbl_File_fluContent;
	private TextView lbl_File_fluCaption;
	private TextView lbl_TitleContent;
	private TextView lbl_TitleCaption;
	private TextView lbl_Thumbnail_fluContent;
	private TextView lbl_Thumbnail_fluCaption;
	private TextView lbl_Add_dateContent;
	private TextView lbl_Add_dateCaption;
	private TextView lbl_DescriptionContent;
	private TextView lbl_DescriptionCaption;
	private TextView lbl_PriceContent;
	private TextView lbl_PriceCaption;
	private TextView lbl_FilecountContent;
	private TextView lbl_FilecountCaption;
	private TextView lbl_Filetype_fidContent;
	private TextView lbl_Filetype_fidCaption;
	private TextView lbl_Role_systemuser_fidContent;
	private TextView lbl_Role_systemuser_fidCaption;
	public FileItemFragment() {
	}
	@Override
	public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
	super.onViewCreated(view, savedInstanceState);
	Typeface face= Typeface.createFromAsset(getActivity().getAssets(),"fonts/IRANSansMobile.ttf");
	lbl_File_fluContent=(TextView)getActivity().findViewById(R.id.lbl_file_flu_content);
	lbl_File_fluCaption=(TextView)getActivity().findViewById(R.id.lbl_file_flu_caption);
	lbl_TitleContent=(TextView)getActivity().findViewById(R.id.lbl_title_content);
	lbl_TitleCaption=(TextView)getActivity().findViewById(R.id.lbl_title_caption);
	lbl_Thumbnail_fluContent=(TextView)getActivity().findViewById(R.id.lbl_thumbnail_flu_content);
	lbl_Thumbnail_fluCaption=(TextView)getActivity().findViewById(R.id.lbl_thumbnail_flu_caption);
	lbl_Add_dateContent=(TextView)getActivity().findViewById(R.id.lbl_add_date_content);
	lbl_Add_dateCaption=(TextView)getActivity().findViewById(R.id.lbl_add_date_caption);
	lbl_DescriptionContent=(TextView)getActivity().findViewById(R.id.lbl_description_content);
	lbl_DescriptionCaption=(TextView)getActivity().findViewById(R.id.lbl_description_caption);
	lbl_PriceContent=(TextView)getActivity().findViewById(R.id.lbl_price_content);
	lbl_PriceCaption=(TextView)getActivity().findViewById(R.id.lbl_price_caption);
	lbl_FilecountContent=(TextView)getActivity().findViewById(R.id.lbl_filecount_content);
	lbl_FilecountCaption=(TextView)getActivity().findViewById(R.id.lbl_filecount_caption);
	lbl_Filetype_fidContent=(TextView)getActivity().findViewById(R.id.lbl_filetype_fid_content);
	lbl_Filetype_fidCaption=(TextView)getActivity().findViewById(R.id.lbl_filetype_fid_caption);
	lbl_Role_systemuser_fidContent=(TextView)getActivity().findViewById(R.id.lbl_role_systemuser_fid_content);
	lbl_Role_systemuser_fidCaption=(TextView)getActivity().findViewById(R.id.lbl_role_systemuser_fid_caption);
	lbl_File_fluContent.setTypeface(face);
	lbl_File_fluCaption.setTypeface(face);
	lbl_TitleContent.setTypeface(face);
	lbl_TitleCaption.setTypeface(face);
	lbl_Thumbnail_fluContent.setTypeface(face);
	lbl_Thumbnail_fluCaption.setTypeface(face);
	lbl_Add_dateContent.setTypeface(face);
	lbl_Add_dateCaption.setTypeface(face);
	lbl_DescriptionContent.setTypeface(face);
	lbl_DescriptionCaption.setTypeface(face);
	lbl_PriceContent.setTypeface(face);
	lbl_PriceCaption.setTypeface(face);
	lbl_FilecountContent.setTypeface(face);
	lbl_FilecountCaption.setTypeface(face);
	lbl_Filetype_fidContent.setTypeface(face);
	lbl_Filetype_fidCaption.setTypeface(face);
	lbl_Role_systemuser_fidContent.setTypeface(face);
	lbl_Role_systemuser_fidCaption.setTypeface(face);
	}
	private void ReloadData()
	{
	lbl_File_fluContent.setText(theFile.getFile_flu());
	lbl_TitleContent.setText(theFile.getTitle());
	lbl_Thumbnail_fluContent.setText(theFile.getThumbnail_flu());
	lbl_Add_dateContent.setText(theFile.getAdd_date());
	lbl_DescriptionContent.setText(theFile.getDescription());
	lbl_PriceContent.setText(theFile.getPrice());
	lbl_FilecountContent.setText(theFile.getFilecount());
	lbl_Filetype_fidContent.setText(theFile.getFiletype_fid());
	lbl_Role_systemuser_fidContent.setText(theFile.getRole_systemuser_fid());
	}        
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        AsyncTask.execute(new Runnable() {
			@Override
			public void run() {
				theFile=new File(getActivity()).getOne(((MainActivity)getActivity()).ItemID);
				getActivity().runOnUiThread(new Runnable() {
					@Override
					public void run() {
						ReloadData();
					}
				});
			}
		});
        View view = inflater.inflate(R.layout.fragment_file_item, container, false);
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