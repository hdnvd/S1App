package fileshop;
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
public class FiletransactionRecyclerViewAdapter extends RecyclerView.Adapter<FiletransactionRecyclerViewAdapter.ViewHolder> {
	private final List<Filetransaction> mValues;
	private final FiletransactionFragment.OnListFragmentInteractionListener mListener;
	public MainActivity theActivity;
	public FiletransactionRecyclerViewAdapter(List<Filetransaction> items, FiletransactionFragment.OnListFragmentInteractionListener listener) {
		mValues = items;
		mListener = listener;
	}
	@Override
		public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
			View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.fragment_filetransaction, parent, false);
			return new ViewHolder(view);
		}
	@Override
		public void onBindViewHolder(final ViewHolder holder, int position) {
			holder.mItem = mValues.get(position);
			holder.mView.setOnClickListener(new View.OnClickListener() {
				@Override
				public void onClick(View v) {
					theActivity.ItemID=holder.mItem.getId();
					theActivity.showFragment(FiletransactionItemFragment.class);
				}
			});
			holder.File_fid.setText(String.valueOf(mValues.get(position).getFile_fid()));
			holder.Finance_bankpaymentinfo_fid.setText(String.valueOf(mValues.get(position).getFinance_bankpaymentinfo_fid()));
		}
	@Override
		public int getItemCount() {
			return mValues.size();
		}
	public class ViewHolder extends RecyclerView.ViewHolder {
		public final View mView;
		public final TextView File_fid;
		public final TextView File_fidLabel;
		public final TextView Finance_bankpaymentinfo_fid;
		public final TextView Finance_bankpaymentinfo_fidLabel;
		public Filetransaction mItem;
		public ViewHolder(View view) {
			super(view);
			mView = view;
			Typeface face= Typeface.createFromAsset(theActivity.getAssets(),"fonts/IRANSansMobile.ttf");
			File_fid = view.findViewById(R.id.file_fid);
			File_fid.setTypeface(face);
			File_fidLabel = view.findViewById(R.id.file_fidlabel);
			File_fidLabel.setTypeface(face);
			Finance_bankpaymentinfo_fid = view.findViewById(R.id.finance_bankpaymentinfo_fid);
			Finance_bankpaymentinfo_fid.setTypeface(face);
			Finance_bankpaymentinfo_fidLabel = view.findViewById(R.id.finance_bankpaymentinfo_fidlabel);
			Finance_bankpaymentinfo_fidLabel.setTypeface(face);
		}
		@Override
		public String toString() {
			return super.toString();
		}
	}	}