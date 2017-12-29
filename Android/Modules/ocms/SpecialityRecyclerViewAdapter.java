package ocms;
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
public class SpecialityRecyclerViewAdapter extends RecyclerView.Adapter<SpecialityRecyclerViewAdapter.ViewHolder> {
	private final List<Speciality> mValues;
	private final SpecialityFragment.OnListFragmentInteractionListener mListener;
	public MainActivity theActivity;
	public SpecialityRecyclerViewAdapter(List<Speciality> items, SpecialityFragment.OnListFragmentInteractionListener listener) {
		mValues = items;
		mListener = listener;
	}
	@Override
		public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
			View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.fragment_speciality, parent, false);
			return new ViewHolder(view);
		}
	@Override
		public void onBindViewHolder(final ViewHolder holder, int position) {
			holder.mItem = mValues.get(position);
			holder.mView.setOnClickListener(new View.OnClickListener() {
				@Override
				public void onClick(View v) {
					theActivity.ItemID=holder.mItem.getId();
					theActivity.showFragment(SpecialityItemFragment.class);
				}
			});
			holder.Title.setText(String.valueOf(mValues.get(position).getTitle()));
			holder.Speciality_fid.setText(String.valueOf(mValues.get(position).getSpeciality_fid()));
		}
	@Override
		public int getItemCount() {
			return mValues.size();
		}
	public class ViewHolder extends RecyclerView.ViewHolder {
		public final View mView;
		public final TextView Title;
		public final TextView TitleLabel;
		public final TextView Speciality_fid;
		public final TextView Speciality_fidLabel;
		public Speciality mItem;
		public ViewHolder(View view) {
			super(view);
			mView = view;
			Typeface face= Typeface.createFromAsset(theActivity.getAssets(),"fonts/IRANSansMobile.ttf");
			Title = view.findViewById(R.id.title);
			Title.setTypeface(face);
			TitleLabel = view.findViewById(R.id.titlelabel);
			TitleLabel.setTypeface(face);
			Speciality_fid = view.findViewById(R.id.speciality_fid);
			Speciality_fid.setTypeface(face);
			Speciality_fidLabel = view.findViewById(R.id.speciality_fidlabel);
			Speciality_fidLabel.setTypeface(face);
		}
		@Override
		public String toString() {
			return super.toString();
		}
	}	}