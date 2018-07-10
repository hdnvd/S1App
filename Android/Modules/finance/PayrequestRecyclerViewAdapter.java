package finance;
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
public class PayrequestRecyclerViewAdapter extends RecyclerView.Adapter<PayrequestRecyclerViewAdapter.ViewHolder> {
	private final List<Payrequest> mValues;
	private final PayrequestFragment.OnListFragmentInteractionListener mListener;
	public MainActivity theActivity;
	public PayrequestRecyclerViewAdapter(List<Payrequest> items, PayrequestFragment.OnListFragmentInteractionListener listener) {
		mValues = items;
		mListener = listener;
	}
	@Override
		public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
			View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.fragment_payrequest, parent, false);
			return new ViewHolder(view);
		}
	@Override
		public void onBindViewHolder(final ViewHolder holder, int position) {
			holder.mItem = mValues.get(position);
			holder.mView.setOnClickListener(new View.OnClickListener() {
				@Override
				public void onClick(View v) {
					theActivity.ItemID=holder.mItem.getId();
					theActivity.showFragment(PayrequestItemFragment.class);
				}
			});
			holder.Role_systemuser_fid.setText(String.valueOf(mValues.get(position).getRole_systemuser_fid()));
			holder.Request_date.setText(String.valueOf(mValues.get(position).getRequest_date()));
			holder.Price.setText(String.valueOf(mValues.get(position).getPrice()));
			holder.Commit_date.setText(String.valueOf(mValues.get(position).getCommit_date()));
			holder.Committype_fid.setText(String.valueOf(mValues.get(position).getCommittype_fid()));
		}
	@Override
		public int getItemCount() {
			return mValues.size();
		}
	public class ViewHolder extends RecyclerView.ViewHolder {
		public final View mView;
		public final TextView Role_systemuser_fid;
		public final TextView Role_systemuser_fidLabel;
		public final TextView Request_date;
		public final TextView Request_dateLabel;
		public final TextView Price;
		public final TextView PriceLabel;
		public final TextView Commit_date;
		public final TextView Commit_dateLabel;
		public final TextView Committype_fid;
		public final TextView Committype_fidLabel;
		public Payrequest mItem;
		public ViewHolder(View view) {
			super(view);
			mView = view;
			Typeface face= Typeface.createFromAsset(theActivity.getAssets(),"fonts/IRANSansMobile.ttf");
			Role_systemuser_fid = view.findViewById(R.id.role_systemuser_fid);
			Role_systemuser_fid.setTypeface(face);
			Role_systemuser_fidLabel = view.findViewById(R.id.role_systemuser_fidlabel);
			Role_systemuser_fidLabel.setTypeface(face);
			Request_date = view.findViewById(R.id.request_date);
			Request_date.setTypeface(face);
			Request_dateLabel = view.findViewById(R.id.request_datelabel);
			Request_dateLabel.setTypeface(face);
			Price = view.findViewById(R.id.price);
			Price.setTypeface(face);
			PriceLabel = view.findViewById(R.id.pricelabel);
			PriceLabel.setTypeface(face);
			Commit_date = view.findViewById(R.id.commit_date);
			Commit_date.setTypeface(face);
			Commit_dateLabel = view.findViewById(R.id.commit_datelabel);
			Commit_dateLabel.setTypeface(face);
			Committype_fid = view.findViewById(R.id.committype_fid);
			Committype_fid.setTypeface(face);
			Committype_fidLabel = view.findViewById(R.id.committype_fidlabel);
			Committype_fidLabel.setTypeface(face);
		}
		@Override
		public String toString() {
			return super.toString();
		}
	}	}