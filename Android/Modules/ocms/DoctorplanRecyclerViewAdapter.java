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
public class DoctorplanRecyclerViewAdapter extends RecyclerView.Adapter<DoctorplanRecyclerViewAdapter.ViewHolder> {
	private final List<Doctorplan> mValues;
	private final DoctorplanFragment.OnListFragmentInteractionListener mListener;
	public MainActivity theActivity;
	public DoctorplanRecyclerViewAdapter(List<Doctorplan> items, DoctorplanFragment.OnListFragmentInteractionListener listener) {
		mValues = items;
		mListener = listener;
	}
	@Override
		public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
			View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.fragment_doctorplan, parent, false);
			return new ViewHolder(view);
		}
	@Override
		public void onBindViewHolder(final ViewHolder holder, int position) {
			holder.mItem = mValues.get(position);
			holder.mView.setOnClickListener(new View.OnClickListener() {
				@Override
				public void onClick(View v) {
					theActivity.ItemID=holder.mItem.getId();
					theActivity.showFragment(DoctorplanItemFragment.class);
				}
			});
			holder.Start_time.setText(String.valueOf(mValues.get(position).getStart_time()));
			holder.End_time.setText(String.valueOf(mValues.get(position).getEnd_time()));
			holder.Doctor_fid.setText(String.valueOf(mValues.get(position).getDoctor_fid()));
		}
	@Override
		public int getItemCount() {
			return mValues.size();
		}
	public class ViewHolder extends RecyclerView.ViewHolder {
		public final View mView;
		public final TextView Start_time;
		public final TextView Start_timeLabel;
		public final TextView End_time;
		public final TextView End_timeLabel;
		public final TextView Doctor_fid;
		public final TextView Doctor_fidLabel;
		public Doctorplan mItem;
		public ViewHolder(View view) {
			super(view);
			mView = view;
			Typeface face= Typeface.createFromAsset(theActivity.getAssets(),"fonts/IRANSansMobile.ttf");
			Start_time = view.findViewById(R.id.start_time);
			Start_time.setTypeface(face);
			Start_timeLabel = view.findViewById(R.id.start_timelabel);
			Start_timeLabel.setTypeface(face);
			End_time = view.findViewById(R.id.end_time);
			End_time.setTypeface(face);
			End_timeLabel = view.findViewById(R.id.end_timelabel);
			End_timeLabel.setTypeface(face);
			Doctor_fid = view.findViewById(R.id.doctor_fid);
			Doctor_fid.setTypeface(face);
			Doctor_fidLabel = view.findViewById(R.id.doctor_fidlabel);
			Doctor_fidLabel.setTypeface(face);
		}
		@Override
		public String toString() {
			return super.toString();
		}
	}	}