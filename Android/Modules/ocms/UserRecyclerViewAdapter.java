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
public class UserRecyclerViewAdapter extends RecyclerView.Adapter<UserRecyclerViewAdapter.ViewHolder> {
	private final List<User> mValues;
	private final UserFragment.OnListFragmentInteractionListener mListener;
	public MainActivity theActivity;
	public UserRecyclerViewAdapter(List<User> items, UserFragment.OnListFragmentInteractionListener listener) {
		mValues = items;
		mListener = listener;
	}
	@Override
		public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
			View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.fragment_user, parent, false);
			return new ViewHolder(view);
		}
	@Override
		public void onBindViewHolder(final ViewHolder holder, int position) {
			holder.mItem = mValues.get(position);
			holder.mView.setOnClickListener(new View.OnClickListener() {
				@Override
				public void onClick(View v) {
					theActivity.ItemID=holder.mItem.getId();
					theActivity.showFragment(UserItemFragment.class);
				}
			});
			holder.Name.setText(String.valueOf(mValues.get(position).getName()));
			holder.Family.setText(String.valueOf(mValues.get(position).getFamily()));
			holder.Born_date.setText(String.valueOf(mValues.get(position).getBorn_date()));
			holder.Mobile.setText(String.valueOf(mValues.get(position).getMobile()));
			holder.Device_id.setText(String.valueOf(mValues.get(position).getDevice_id()));
			holder.Email.setText(String.valueOf(mValues.get(position).getEmail()));
			holder.Ismale.setText(String.valueOf(mValues.get(position).getIsmale()));
		}
	@Override
		public int getItemCount() {
			return mValues.size();
		}
	public class ViewHolder extends RecyclerView.ViewHolder {
		public final View mView;
		public final TextView Name;
		public final TextView NameLabel;
		public final TextView Family;
		public final TextView FamilyLabel;
		public final TextView Born_date;
		public final TextView Born_dateLabel;
		public final TextView Mobile;
		public final TextView MobileLabel;
		public final TextView Device_id;
		public final TextView Device_idLabel;
		public final TextView Email;
		public final TextView EmailLabel;
		public final TextView Ismale;
		public final TextView IsmaleLabel;
		public User mItem;
		public ViewHolder(View view) {
			super(view);
			mView = view;
			Typeface face= Typeface.createFromAsset(theActivity.getAssets(),"fonts/IRANSansMobile.ttf");
			Name = view.findViewById(R.id.name);
			Name.setTypeface(face);
			NameLabel = view.findViewById(R.id.namelabel);
			NameLabel.setTypeface(face);
			Family = view.findViewById(R.id.family);
			Family.setTypeface(face);
			FamilyLabel = view.findViewById(R.id.familylabel);
			FamilyLabel.setTypeface(face);
			Born_date = view.findViewById(R.id.born_date);
			Born_date.setTypeface(face);
			Born_dateLabel = view.findViewById(R.id.born_datelabel);
			Born_dateLabel.setTypeface(face);
			Mobile = view.findViewById(R.id.mobile);
			Mobile.setTypeface(face);
			MobileLabel = view.findViewById(R.id.mobilelabel);
			MobileLabel.setTypeface(face);
			Device_id = view.findViewById(R.id.device_id);
			Device_id.setTypeface(face);
			Device_idLabel = view.findViewById(R.id.device_idlabel);
			Device_idLabel.setTypeface(face);
			Email = view.findViewById(R.id.email);
			Email.setTypeface(face);
			EmailLabel = view.findViewById(R.id.emaillabel);
			EmailLabel.setTypeface(face);
			Ismale = view.findViewById(R.id.ismale);
			Ismale.setTypeface(face);
			IsmaleLabel = view.findViewById(R.id.ismalelabel);
			IsmaleLabel.setTypeface(face);
		}
		@Override
		public String toString() {
			return super.toString();
		}
	}	}