package common;
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
import common.Category;
public class CategoryItemFragment extends Fragment {
	private OnFragmentInteractionListener mListener;
	private Category theCategory;
	private TextView lbl_TitleContent;
	private TextView lbl_TitleCaption;
	private TextView lbl_LatintitleContent;
	private TextView lbl_LatintitleCaption;
	private TextView lbl_Category_fidContent;
	private TextView lbl_Category_fidCaption;
	public CategoryItemFragment() {
	}
	@Override
	public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
	super.onViewCreated(view, savedInstanceState);
	Typeface face= Typeface.createFromAsset(getActivity().getAssets(),"fonts/IRANSansMobile.ttf");
	lbl_TitleContent=(TextView)getActivity().findViewById(R.id.lbl_title_content);
	lbl_TitleCaption=(TextView)getActivity().findViewById(R.id.lbl_title_caption);
	lbl_LatintitleContent=(TextView)getActivity().findViewById(R.id.lbl_latintitle_content);
	lbl_LatintitleCaption=(TextView)getActivity().findViewById(R.id.lbl_latintitle_caption);
	lbl_Category_fidContent=(TextView)getActivity().findViewById(R.id.lbl_category_fid_content);
	lbl_Category_fidCaption=(TextView)getActivity().findViewById(R.id.lbl_category_fid_caption);
	lbl_TitleContent.setTypeface(face);
	lbl_TitleCaption.setTypeface(face);
	lbl_LatintitleContent.setTypeface(face);
	lbl_LatintitleCaption.setTypeface(face);
	lbl_Category_fidContent.setTypeface(face);
	lbl_Category_fidCaption.setTypeface(face);
	}
	private void ReloadData()
	{
	lbl_TitleContent.setText(theCategory.getTitle());
	lbl_LatintitleContent.setText(theCategory.getLatintitle());
	lbl_Category_fidContent.setText(theCategory.getCategory_fid());
	}        
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        AsyncTask.execute(new Runnable() {
			@Override
			public void run() {
				theCategory=new Category(getActivity()).getOne(((MainActivity)getActivity()).ItemID);
				getActivity().runOnUiThread(new Runnable() {
					@Override
					public void run() {
						ReloadData();
					}
				});
			}
		});
        View view = inflater.inflate(R.layout.fragment_category_item, container, false);
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