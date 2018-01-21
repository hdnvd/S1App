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
public class FileRecyclerViewAdapter extends RecyclerView.Adapter<FileRecyclerViewAdapter.ViewHolder> {
	private final List<File> mValues;
	private final FileFragment.OnListFragmentInteractionListener mListener;
	public MainActivity theActivity;
	public FileRecyclerViewAdapter(List<File> items, FileFragment.OnListFragmentInteractionListener listener) {
		mValues = items;
		mListener = listener;
	}
	@Override
		public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
			View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.fragment_file, parent, false);
			return new ViewHolder(view);
		}
	@Override
		public void onBindViewHolder(final ViewHolder holder, int position) {
			holder.mItem = mValues.get(position);
			holder.mView.setOnClickListener(new View.OnClickListener() {
				@Override
				public void onClick(View v) {
					theActivity.ItemID=holder.mItem.getId();
					theActivity.showFragment(FileItemFragment.class);
				}
			});
			holder.File_flu.setText(String.valueOf(mValues.get(position).getFile_flu()));
			holder.Title.setText(String.valueOf(mValues.get(position).getTitle()));
			holder.Thumbnail_flu.setText(String.valueOf(mValues.get(position).getThumbnail_flu()));
			holder.Add_date.setText(String.valueOf(mValues.get(position).getAdd_date()));
			holder.Description.setText(String.valueOf(mValues.get(position).getDescription()));
			holder.Price.setText(String.valueOf(mValues.get(position).getPrice()));
			holder.Filecount.setText(String.valueOf(mValues.get(position).getFilecount()));
			holder.Filetype_fid.setText(String.valueOf(mValues.get(position).getFiletype_fid()));
			holder.Role_systemuser_fid.setText(String.valueOf(mValues.get(position).getRole_systemuser_fid()));
		}
	@Override
		public int getItemCount() {
			return mValues.size();
		}
	public class ViewHolder extends RecyclerView.ViewHolder {
		public final View mView;
		public final TextView File_flu;
		public final TextView File_fluLabel;
		public final TextView Title;
		public final TextView TitleLabel;
		public final TextView Thumbnail_flu;
		public final TextView Thumbnail_fluLabel;
		public final TextView Add_date;
		public final TextView Add_dateLabel;
		public final TextView Description;
		public final TextView DescriptionLabel;
		public final TextView Price;
		public final TextView PriceLabel;
		public final TextView Filecount;
		public final TextView FilecountLabel;
		public final TextView Filetype_fid;
		public final TextView Filetype_fidLabel;
		public final TextView Role_systemuser_fid;
		public final TextView Role_systemuser_fidLabel;
		public File mItem;
		public ViewHolder(View view) {
			super(view);
			mView = view;
			Typeface face= Typeface.createFromAsset(theActivity.getAssets(),"fonts/IRANSansMobile.ttf");
			File_flu = view.findViewById(R.id.file_flu);
			File_flu.setTypeface(face);
			File_fluLabel = view.findViewById(R.id.file_flulabel);
			File_fluLabel.setTypeface(face);
			Title = view.findViewById(R.id.title);
			Title.setTypeface(face);
			TitleLabel = view.findViewById(R.id.titlelabel);
			TitleLabel.setTypeface(face);
			Thumbnail_flu = view.findViewById(R.id.thumbnail_flu);
			Thumbnail_flu.setTypeface(face);
			Thumbnail_fluLabel = view.findViewById(R.id.thumbnail_flulabel);
			Thumbnail_fluLabel.setTypeface(face);
			Add_date = view.findViewById(R.id.add_date);
			Add_date.setTypeface(face);
			Add_dateLabel = view.findViewById(R.id.add_datelabel);
			Add_dateLabel.setTypeface(face);
			Description = view.findViewById(R.id.description);
			Description.setTypeface(face);
			DescriptionLabel = view.findViewById(R.id.descriptionlabel);
			DescriptionLabel.setTypeface(face);
			Price = view.findViewById(R.id.price);
			Price.setTypeface(face);
			PriceLabel = view.findViewById(R.id.pricelabel);
			PriceLabel.setTypeface(face);
			Filecount = view.findViewById(R.id.filecount);
			Filecount.setTypeface(face);
			FilecountLabel = view.findViewById(R.id.filecountlabel);
			FilecountLabel.setTypeface(face);
			Filetype_fid = view.findViewById(R.id.filetype_fid);
			Filetype_fid.setTypeface(face);
			Filetype_fidLabel = view.findViewById(R.id.filetype_fidlabel);
			Filetype_fidLabel.setTypeface(face);
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