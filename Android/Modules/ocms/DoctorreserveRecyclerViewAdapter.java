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
public class DoctorreserveRecyclerViewAdapter extends RecyclerView.Adapter<DoctorreserveRecyclerViewAdapter.ViewHolder> {
	private final List<Doctorreserve> mValues;
	private final DoctorreserveFragment.OnListFragmentInteractionListener mListener;
	public MainActivity theActivity;
	public DoctorreserveRecyclerViewAdapter(List<Doctorreserve> items, DoctorreserveFragment.OnListFragmentInteractionListener listener) {
		mValues = items;
		mListener = listener;
	}
	@Override
		public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
			View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.fragment_doctorreserve, parent, false);
			return new ViewHolder(view);
		}
	@Override
		public void onBindViewHolder(final ViewHolder holder, int position) {
			holder.mItem = mValues.get(position);
			holder.mView.setOnClickListener(new View.OnClickListener() {
				@Override
				public void onClick(View v) {
					theActivity.ItemID=holder.mItem.getId();
					theActivity.showFragment(DoctorreserveItemFragment.class);
				}
			});
			holder.Doctorplan_fid.setText(String.valueOf(mValues.get(position).getDoctorplan_fid()));
			holder.Financial_transaction_fid.setText(String.valueOf(mValues.get(position).getFinancial_transaction_fid()));
			holder.Presencetype_fid.setText(String.valueOf(mValues.get(position).getPresencetype_fid()));
			holder.Reserve_date.setText(String.valueOf(mValues.get(position).getReserve_date()));
			holder.Role_systemuser_fid.setText(String.valueOf(mValues.get(position).getRole_systemuser_fid()));
		}
	@Override
		public int getItemCount() {
			return mValues.size();
		}
	public class ViewHolder extends RecyclerView.ViewHolder {
		public final View mView;
		public final TextView Doctorplan_fid;
		public final TextView Doctorplan_fidLabel;
		public final TextView Financial_transaction_fid;
		public final TextView Financial_transaction_fidLabel;
		public final TextView Presencetype_fid;
		public final TextView Presencetype_fidLabel;
		public final TextView Reserve_date;
		public final TextView Reserve_dateLabel;
		public final TextView Role_systemuser_fid;
		public final TextView Role_systemuser_fidLabel;
		public Doctorreserve mItem;
		public ViewHolder(View view) {
			super(view);
			mView = view;
			Typeface face= Typeface.createFromAsset(theActivity.getAssets(),"fonts/IRANSansMobile.ttf");
			Doctorplan_fid = view.findViewById(R.id.doctorplan_fid);
			Doctorplan_fid.setTypeface(face);
			Doctorplan_fidLabel = view.findViewById(R.id.doctorplan_fidlabel);
			Doctorplan_fidLabel.setTypeface(face);
			Financial_transaction_fid = view.findViewById(R.id.financial_transaction_fid);
			Financial_transaction_fid.setTypeface(face);
			Financial_transaction_fidLabel = view.findViewById(R.id.financial_transaction_fidlabel);
			Financial_transaction_fidLabel.setTypeface(face);
			Presencetype_fid = view.findViewById(R.id.presencetype_fid);
			Presencetype_fid.setTypeface(face);
			Presencetype_fidLabel = view.findViewById(R.id.presencetype_fidlabel);
			Presencetype_fidLabel.setTypeface(face);
			Reserve_date = view.findViewById(R.id.reserve_date);
			Reserve_date.setTypeface(face);
			Reserve_dateLabel = view.findViewById(R.id.reserve_datelabel);
			Reserve_dateLabel.setTypeface(face);
			Role_systemuser_fid = view.findViewById(R.id.role_systemuser_fid);
			Role_systemuser_fid.setTypeface(face);
			Role_systemuser_fidLabel = view.findViewById(R.id.role_systemuser_fidlabel);
			Role_systemuser_fidLabel.setTypeface(face);
		}
		@Override
		public String toString() {
			return super.toString();
		}
	}	}