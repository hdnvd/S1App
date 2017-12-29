package messaging;
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
public class MessageRecyclerViewAdapter extends RecyclerView.Adapter<MessageRecyclerViewAdapter.ViewHolder> {
	private final List<Message> mValues;
	private final MessageFragment.OnListFragmentInteractionListener mListener;
	public MainActivity theActivity;
	public MessageRecyclerViewAdapter(List<Message> items, MessageFragment.OnListFragmentInteractionListener listener) {
		mValues = items;
		mListener = listener;
	}
	@Override
		public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
			View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.fragment_message, parent, false);
			return new ViewHolder(view);
		}
	@Override
		public void onBindViewHolder(final ViewHolder holder, int position) {
			holder.mItem = mValues.get(position);
			holder.mView.setOnClickListener(new View.OnClickListener() {
				@Override
				public void onClick(View v) {
					theActivity.ItemID=holder.mItem.getId();
					theActivity.showFragment(MessageItemFragment.class);
				}
			});
			holder.Sender_role_systemuser_fid.setText(String.valueOf(mValues.get(position).getSender_role_systemuser_fid()));
			holder.Receiver_role_systemuser_fid.setText(String.valueOf(mValues.get(position).getReceiver_role_systemuser_fid()));
			holder.Send_date.setText(String.valueOf(mValues.get(position).getSend_date()));
			holder.Title.setText(String.valueOf(mValues.get(position).getTitle()));
			holder.Messagetext.setText(String.valueOf(mValues.get(position).getMessagetext()));
		}
	@Override
		public int getItemCount() {
			return mValues.size();
		}
	public class ViewHolder extends RecyclerView.ViewHolder {
		public final View mView;
		public final TextView Sender_role_systemuser_fid;
		public final TextView Sender_role_systemuser_fidLabel;
		public final TextView Receiver_role_systemuser_fid;
		public final TextView Receiver_role_systemuser_fidLabel;
		public final TextView Send_date;
		public final TextView Send_dateLabel;
		public final TextView Title;
		public final TextView TitleLabel;
		public final TextView Messagetext;
		public final TextView MessagetextLabel;
		public Message mItem;
		public ViewHolder(View view) {
			super(view);
			mView = view;
			Typeface face= Typeface.createFromAsset(theActivity.getAssets(),"fonts/IRANSansMobile.ttf");
			Sender_role_systemuser_fid = view.findViewById(R.id.sender_role_systemuser_fid);
			Sender_role_systemuser_fid.setTypeface(face);
			Sender_role_systemuser_fidLabel = view.findViewById(R.id.sender_role_systemuser_fidlabel);
			Sender_role_systemuser_fidLabel.setTypeface(face);
			Receiver_role_systemuser_fid = view.findViewById(R.id.receiver_role_systemuser_fid);
			Receiver_role_systemuser_fid.setTypeface(face);
			Receiver_role_systemuser_fidLabel = view.findViewById(R.id.receiver_role_systemuser_fidlabel);
			Receiver_role_systemuser_fidLabel.setTypeface(face);
			Send_date = view.findViewById(R.id.send_date);
			Send_date.setTypeface(face);
			Send_dateLabel = view.findViewById(R.id.send_datelabel);
			Send_dateLabel.setTypeface(face);
			Title = view.findViewById(R.id.title);
			Title.setTypeface(face);
			TitleLabel = view.findViewById(R.id.titlelabel);
			TitleLabel.setTypeface(face);
			Messagetext = view.findViewById(R.id.messagetext);
			Messagetext.setTypeface(face);
			MessagetextLabel = view.findViewById(R.id.messagetextlabel);
			MessagetextLabel.setTypeface(face);
		}
		@Override
		public String toString() {
			return super.toString();
		}
	}	}