package eshop;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.ColorFilter;
import android.graphics.LightingColorFilter;
import android.graphics.Typeface;
import android.graphics.drawable.Drawable;
import android.net.Uri;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;
import java.util.List;
public class ProductRecyclerViewAdapter extends RecyclerView.Adapter<ProductRecyclerViewAdapter.ViewHolder> {
	private final List<Product> mValues;
	private final ProductFragment.OnListFragmentInteractionListener mListener;
	public MainActivity theActivity;
	public ProductRecyclerViewAdapter(List<Product> items, ProductFragment.OnListFragmentInteractionListener listener) {
		mValues = items;
		mListener = listener;
	}
	@Override
		public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
			View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.fragment_product, parent, false);
			return new ViewHolder(view);
		}
	@Override
		public void onBindViewHolder(final ViewHolder holder, int position) {
			holder.mItem = mValues.get(position);
			holder.mView.setOnClickListener(new View.OnClickListener() {
				@Override
				public void onClick(View v) {
					theActivity.ItemID=holder.mItem.getId();
					theActivity.showFragment(ProductItemFragment.class);
				}
			});
			holder.Title.setText(String.valueOf(mValues.get(position).getTitle()));
			holder.Latintitle.setText(String.valueOf(mValues.get(position).getLatintitle()));
			holder.Description.setText(String.valueOf(mValues.get(position).getDescription()));
			holder.Pic1_flu.setText(String.valueOf(mValues.get(position).getPic1_flu()));
			holder.Pic2_flu.setText(String.valueOf(mValues.get(position).getPic2_flu()));
			holder.Pic3_flu.setText(String.valueOf(mValues.get(position).getPic3_flu()));
			holder.Pic4_flu.setText(String.valueOf(mValues.get(position).getPic4_flu()));
			holder.Price.setText(String.valueOf(mValues.get(position).getPrice()));
			holder.Code.setText(String.valueOf(mValues.get(position).getCode()));
			holder.Adddate.setText(String.valueOf(mValues.get(position).getAdddate()));
			holder.Visitcount.setText(String.valueOf(mValues.get(position).getVisitcount()));
			holder.Is_exists.setText(String.valueOf(mValues.get(position).getIs_exists()));
		}
	@Override
		public int getItemCount() {
			return mValues.size();
		}
	public class ViewHolder extends RecyclerView.ViewHolder {
		public final View mView;
		public final TextView Title;
		public final TextView TitleLabel;
		public final TextView Latintitle;
		public final TextView LatintitleLabel;
		public final TextView Description;
		public final TextView DescriptionLabel;
		public final TextView Pic1_flu;
		public final TextView Pic1_fluLabel;
		public final TextView Pic2_flu;
		public final TextView Pic2_fluLabel;
		public final TextView Pic3_flu;
		public final TextView Pic3_fluLabel;
		public final TextView Pic4_flu;
		public final TextView Pic4_fluLabel;
		public final TextView Price;
		public final TextView PriceLabel;
		public final TextView Code;
		public final TextView CodeLabel;
		public final TextView Adddate;
		public final TextView AdddateLabel;
		public final TextView Visitcount;
		public final TextView VisitcountLabel;
		public final TextView Is_exists;
		public final TextView Is_existsLabel;
		public Product mItem;
		public ViewHolder(View view) {
			super(view);
			mView = view;
			Typeface face= Typeface.createFromAsset(theActivity.getAssets(),"fonts/IRANSansMobile.ttf");
			Title = view.findViewById(R.id.title);
			Title.setTypeface(face);
			TitleLabel = view.findViewById(R.id.titlelabel);
			TitleLabel.setTypeface(face);
			Latintitle = view.findViewById(R.id.latintitle);
			Latintitle.setTypeface(face);
			LatintitleLabel = view.findViewById(R.id.latintitlelabel);
			LatintitleLabel.setTypeface(face);
			Description = view.findViewById(R.id.description);
			Description.setTypeface(face);
			DescriptionLabel = view.findViewById(R.id.descriptionlabel);
			DescriptionLabel.setTypeface(face);
			Pic1_flu = view.findViewById(R.id.pic1_flu);
			Pic1_flu.setTypeface(face);
			Pic1_fluLabel = view.findViewById(R.id.pic1_flulabel);
			Pic1_fluLabel.setTypeface(face);
			Pic2_flu = view.findViewById(R.id.pic2_flu);
			Pic2_flu.setTypeface(face);
			Pic2_fluLabel = view.findViewById(R.id.pic2_flulabel);
			Pic2_fluLabel.setTypeface(face);
			Pic3_flu = view.findViewById(R.id.pic3_flu);
			Pic3_flu.setTypeface(face);
			Pic3_fluLabel = view.findViewById(R.id.pic3_flulabel);
			Pic3_fluLabel.setTypeface(face);
			Pic4_flu = view.findViewById(R.id.pic4_flu);
			Pic4_flu.setTypeface(face);
			Pic4_fluLabel = view.findViewById(R.id.pic4_flulabel);
			Pic4_fluLabel.setTypeface(face);
			Price = view.findViewById(R.id.price);
			Price.setTypeface(face);
			PriceLabel = view.findViewById(R.id.pricelabel);
			PriceLabel.setTypeface(face);
			Code = view.findViewById(R.id.code);
			Code.setTypeface(face);
			CodeLabel = view.findViewById(R.id.codelabel);
			CodeLabel.setTypeface(face);
			Adddate = view.findViewById(R.id.adddate);
			Adddate.setTypeface(face);
			AdddateLabel = view.findViewById(R.id.adddatelabel);
			AdddateLabel.setTypeface(face);
			Visitcount = view.findViewById(R.id.visitcount);
			Visitcount.setTypeface(face);
			VisitcountLabel = view.findViewById(R.id.visitcountlabel);
			VisitcountLabel.setTypeface(face);
			Is_exists = view.findViewById(R.id.is_exists);
			Is_exists.setTypeface(face);
			Is_existsLabel = view.findViewById(R.id.is_existslabel);
			Is_existsLabel.setTypeface(face);
		}
		@Override
		public String toString() {
			return super.toString();
		}
	}	}