package eshop;
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
import eshop.Product;
public class ProductItemFragment extends Fragment {
	private OnFragmentInteractionListener mListener;
	private Product theProduct;
	private TextView lbl_TitleContent;
	private TextView lbl_TitleCaption;
	private TextView lbl_LatintitleContent;
	private TextView lbl_LatintitleCaption;
	private TextView lbl_DescriptionContent;
	private TextView lbl_DescriptionCaption;
	private TextView lbl_Pic1_fluContent;
	private TextView lbl_Pic1_fluCaption;
	private TextView lbl_Pic2_fluContent;
	private TextView lbl_Pic2_fluCaption;
	private TextView lbl_Pic3_fluContent;
	private TextView lbl_Pic3_fluCaption;
	private TextView lbl_Pic4_fluContent;
	private TextView lbl_Pic4_fluCaption;
	private TextView lbl_PriceContent;
	private TextView lbl_PriceCaption;
	private TextView lbl_CodeContent;
	private TextView lbl_CodeCaption;
	private TextView lbl_AdddateContent;
	private TextView lbl_AdddateCaption;
	private TextView lbl_VisitcountContent;
	private TextView lbl_VisitcountCaption;
	private TextView lbl_Is_existsContent;
	private TextView lbl_Is_existsCaption;
	public ProductItemFragment() {
	}
	@Override
	public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
	super.onViewCreated(view, savedInstanceState);
	Typeface face= Typeface.createFromAsset(getActivity().getAssets(),"fonts/IRANSansMobile.ttf");
	lbl_TitleContent=(TextView)getActivity().findViewById(R.id.lbl_title_content);
	lbl_TitleCaption=(TextView)getActivity().findViewById(R.id.lbl_title_caption);
	lbl_LatintitleContent=(TextView)getActivity().findViewById(R.id.lbl_latintitle_content);
	lbl_LatintitleCaption=(TextView)getActivity().findViewById(R.id.lbl_latintitle_caption);
	lbl_DescriptionContent=(TextView)getActivity().findViewById(R.id.lbl_description_content);
	lbl_DescriptionCaption=(TextView)getActivity().findViewById(R.id.lbl_description_caption);
	lbl_Pic1_fluContent=(TextView)getActivity().findViewById(R.id.lbl_pic1_flu_content);
	lbl_Pic1_fluCaption=(TextView)getActivity().findViewById(R.id.lbl_pic1_flu_caption);
	lbl_Pic2_fluContent=(TextView)getActivity().findViewById(R.id.lbl_pic2_flu_content);
	lbl_Pic2_fluCaption=(TextView)getActivity().findViewById(R.id.lbl_pic2_flu_caption);
	lbl_Pic3_fluContent=(TextView)getActivity().findViewById(R.id.lbl_pic3_flu_content);
	lbl_Pic3_fluCaption=(TextView)getActivity().findViewById(R.id.lbl_pic3_flu_caption);
	lbl_Pic4_fluContent=(TextView)getActivity().findViewById(R.id.lbl_pic4_flu_content);
	lbl_Pic4_fluCaption=(TextView)getActivity().findViewById(R.id.lbl_pic4_flu_caption);
	lbl_PriceContent=(TextView)getActivity().findViewById(R.id.lbl_price_content);
	lbl_PriceCaption=(TextView)getActivity().findViewById(R.id.lbl_price_caption);
	lbl_CodeContent=(TextView)getActivity().findViewById(R.id.lbl_code_content);
	lbl_CodeCaption=(TextView)getActivity().findViewById(R.id.lbl_code_caption);
	lbl_AdddateContent=(TextView)getActivity().findViewById(R.id.lbl_adddate_content);
	lbl_AdddateCaption=(TextView)getActivity().findViewById(R.id.lbl_adddate_caption);
	lbl_VisitcountContent=(TextView)getActivity().findViewById(R.id.lbl_visitcount_content);
	lbl_VisitcountCaption=(TextView)getActivity().findViewById(R.id.lbl_visitcount_caption);
	lbl_Is_existsContent=(TextView)getActivity().findViewById(R.id.lbl_is_exists_content);
	lbl_Is_existsCaption=(TextView)getActivity().findViewById(R.id.lbl_is_exists_caption);
	lbl_TitleContent.setTypeface(face);
	lbl_TitleCaption.setTypeface(face);
	lbl_LatintitleContent.setTypeface(face);
	lbl_LatintitleCaption.setTypeface(face);
	lbl_DescriptionContent.setTypeface(face);
	lbl_DescriptionCaption.setTypeface(face);
	lbl_Pic1_fluContent.setTypeface(face);
	lbl_Pic1_fluCaption.setTypeface(face);
	lbl_Pic2_fluContent.setTypeface(face);
	lbl_Pic2_fluCaption.setTypeface(face);
	lbl_Pic3_fluContent.setTypeface(face);
	lbl_Pic3_fluCaption.setTypeface(face);
	lbl_Pic4_fluContent.setTypeface(face);
	lbl_Pic4_fluCaption.setTypeface(face);
	lbl_PriceContent.setTypeface(face);
	lbl_PriceCaption.setTypeface(face);
	lbl_CodeContent.setTypeface(face);
	lbl_CodeCaption.setTypeface(face);
	lbl_AdddateContent.setTypeface(face);
	lbl_AdddateCaption.setTypeface(face);
	lbl_VisitcountContent.setTypeface(face);
	lbl_VisitcountCaption.setTypeface(face);
	lbl_Is_existsContent.setTypeface(face);
	lbl_Is_existsCaption.setTypeface(face);
	}
	private void ReloadData()
	{
	lbl_TitleContent.setText(theProduct.getTitle());
	lbl_LatintitleContent.setText(theProduct.getLatintitle());
	lbl_DescriptionContent.setText(theProduct.getDescription());
	lbl_Pic1_fluContent.setText(theProduct.getPic1_flu());
	lbl_Pic2_fluContent.setText(theProduct.getPic2_flu());
	lbl_Pic3_fluContent.setText(theProduct.getPic3_flu());
	lbl_Pic4_fluContent.setText(theProduct.getPic4_flu());
	lbl_PriceContent.setText(theProduct.getPrice());
	lbl_CodeContent.setText(theProduct.getCode());
	lbl_AdddateContent.setText(theProduct.getAdddate());
	lbl_VisitcountContent.setText(theProduct.getVisitcount());
	lbl_Is_existsContent.setText(theProduct.getIs_exists());
	}        
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        AsyncTask.execute(new Runnable() {
			@Override
			public void run() {
				theProduct=new Product(getActivity()).getOne(((MainActivity)getActivity()).ItemID);
				getActivity().runOnUiThread(new Runnable() {
					@Override
					public void run() {
						ReloadData();
					}
				});
			}
		});
        View view = inflater.inflate(R.layout.fragment_product_item, container, false);
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