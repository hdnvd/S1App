package common;
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
public class CategoryRecyclerViewAdapter extends RecyclerView.Adapter<CategoryRecyclerViewAdapter.ViewHolder> {
	private final List<Category> mValues;
	private final CategoryFragment.OnListFragmentInteractionListener mListener;
	public MainActivity theActivity;
	public CategoryRecyclerViewAdapter(List<Category> items, CategoryFragment.OnListFragmentInteractionListener listener) {
		mValues = items;
		mListener = listener;
	}
	@Override
		public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
			View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.fragment_category, parent, false);
			return new ViewHolder(view);
		}
	@Override
		public void onBindViewHolder(final ViewHolder holder, int position) {
			holder.mItem = mValues.get(position);
			holder.mView.setOnClickListener(new View.OnClickListener() {
				@Override
				public void onClick(View v) {
					theActivity.ItemID=holder.mItem.getId();
					theActivity.showFragment(CategoryItemFragment.class);
				}
			});
			holder.Title.setText(String.valueOf(mValues.get(position).getTitle()));
			holder.Latintitle.setText(String.valueOf(mValues.get(position).getLatintitle()));
			holder.Category_fid.setText(String.valueOf(mValues.get(position).getCategory_fid()));
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
		public final TextView Category_fid;
		public final TextView Category_fidLabel;
		public Category mItem;
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
			Category_fid = view.findViewById(R.id.category_fid);
			Category_fid.setTypeface(face);
			Category_fidLabel = view.findViewById(R.id.category_fidlabel);
			Category_fidLabel.setTypeface(face);
		}
		@Override
		public String toString() {
			return super.toString();
		}
	}	}