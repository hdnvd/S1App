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
public class DoctorRecyclerViewAdapter extends RecyclerView.Adapter<DoctorRecyclerViewAdapter.ViewHolder> {
	private final List<Doctor> mValues;
	private final DoctorFragment.OnListFragmentInteractionListener mListener;
	public MainActivity theActivity;
	public DoctorRecyclerViewAdapter(List<Doctor> items, DoctorFragment.OnListFragmentInteractionListener listener) {
		mValues = items;
		mListener = listener;
	}
	@Override
		public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
			View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.fragment_doctor, parent, false);
			return new ViewHolder(view);
		}
	@Override
		public void onBindViewHolder(final ViewHolder holder, int position) {
			holder.mItem = mValues.get(position);
			holder.mView.setOnClickListener(new View.OnClickListener() {
				@Override
				public void onClick(View v) {
					theActivity.ItemID=holder.mItem.getId();
					theActivity.showFragment(DoctorItemFragment.class);
				}
			});
			holder.Name.setText(String.valueOf(mValues.get(position).getName()));
			holder.Family.setText(String.valueOf(mValues.get(position).getFamily()));
			holder.Nezam_code.setText(String.valueOf(mValues.get(position).getNezam_code()));
			holder.Mellicode.setText(String.valueOf(mValues.get(position).getMellicode()));
			holder.Mobile.setText(String.valueOf(mValues.get(position).getMobile()));
			holder.Email.setText(String.valueOf(mValues.get(position).getEmail()));
			holder.Tel.setText(String.valueOf(mValues.get(position).getTel()));
			holder.Ismale.setText(String.valueOf(mValues.get(position).getIsmale()));
			holder.Speciality_fid.setText(String.valueOf(mValues.get(position).getSpeciality_fid()));
			holder.Education.setText(String.valueOf(mValues.get(position).getEducation()));
			holder.Matabtel.setText(String.valueOf(mValues.get(position).getMatabtel()));
			holder.Matabaddress.setText(String.valueOf(mValues.get(position).getMatabaddress()));
			holder.Longitude.setText(String.valueOf(mValues.get(position).getLongitude()));
			holder.Latitude.setText(String.valueOf(mValues.get(position).getLatitude()));
			holder.Common_city_fid.setText(String.valueOf(mValues.get(position).getCommon_city_fid()));
			holder.Isactiveonphone.setText(String.valueOf(mValues.get(position).getIsactiveonphone()));
			holder.Isactiveonplace.setText(String.valueOf(mValues.get(position).getIsactiveonplace()));
			holder.Isactiveonhome.setText(String.valueOf(mValues.get(position).getIsactiveonhome()));
			holder.Photo_flu.setText(String.valueOf(mValues.get(position).getPhoto_flu()));
			holder.Role_systemuser_fid.setText(String.valueOf(mValues.get(position).getRole_systemuser_fid()));
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
		public final TextView Nezam_code;
		public final TextView Nezam_codeLabel;
		public final TextView Mellicode;
		public final TextView MellicodeLabel;
		public final TextView Mobile;
		public final TextView MobileLabel;
		public final TextView Email;
		public final TextView EmailLabel;
		public final TextView Tel;
		public final TextView TelLabel;
		public final TextView Ismale;
		public final TextView IsmaleLabel;
		public final TextView Speciality_fid;
		public final TextView Speciality_fidLabel;
		public final TextView Education;
		public final TextView EducationLabel;
		public final TextView Matabtel;
		public final TextView MatabtelLabel;
		public final TextView Matabaddress;
		public final TextView MatabaddressLabel;
		public final TextView Longitude;
		public final TextView LongitudeLabel;
		public final TextView Latitude;
		public final TextView LatitudeLabel;
		public final TextView Common_city_fid;
		public final TextView Common_city_fidLabel;
		public final TextView Isactiveonphone;
		public final TextView IsactiveonphoneLabel;
		public final TextView Isactiveonplace;
		public final TextView IsactiveonplaceLabel;
		public final TextView Isactiveonhome;
		public final TextView IsactiveonhomeLabel;
		public final TextView Photo_flu;
		public final TextView Photo_fluLabel;
		public final TextView Role_systemuser_fid;
		public final TextView Role_systemuser_fidLabel;
		public Doctor mItem;
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
			Nezam_code = view.findViewById(R.id.nezam_code);
			Nezam_code.setTypeface(face);
			Nezam_codeLabel = view.findViewById(R.id.nezam_codelabel);
			Nezam_codeLabel.setTypeface(face);
			Mellicode = view.findViewById(R.id.mellicode);
			Mellicode.setTypeface(face);
			MellicodeLabel = view.findViewById(R.id.mellicodelabel);
			MellicodeLabel.setTypeface(face);
			Mobile = view.findViewById(R.id.mobile);
			Mobile.setTypeface(face);
			MobileLabel = view.findViewById(R.id.mobilelabel);
			MobileLabel.setTypeface(face);
			Email = view.findViewById(R.id.email);
			Email.setTypeface(face);
			EmailLabel = view.findViewById(R.id.emaillabel);
			EmailLabel.setTypeface(face);
			Tel = view.findViewById(R.id.tel);
			Tel.setTypeface(face);
			TelLabel = view.findViewById(R.id.tellabel);
			TelLabel.setTypeface(face);
			Ismale = view.findViewById(R.id.ismale);
			Ismale.setTypeface(face);
			IsmaleLabel = view.findViewById(R.id.ismalelabel);
			IsmaleLabel.setTypeface(face);
			Speciality_fid = view.findViewById(R.id.speciality_fid);
			Speciality_fid.setTypeface(face);
			Speciality_fidLabel = view.findViewById(R.id.speciality_fidlabel);
			Speciality_fidLabel.setTypeface(face);
			Education = view.findViewById(R.id.education);
			Education.setTypeface(face);
			EducationLabel = view.findViewById(R.id.educationlabel);
			EducationLabel.setTypeface(face);
			Matabtel = view.findViewById(R.id.matabtel);
			Matabtel.setTypeface(face);
			MatabtelLabel = view.findViewById(R.id.matabtellabel);
			MatabtelLabel.setTypeface(face);
			Matabaddress = view.findViewById(R.id.matabaddress);
			Matabaddress.setTypeface(face);
			MatabaddressLabel = view.findViewById(R.id.matabaddresslabel);
			MatabaddressLabel.setTypeface(face);
			Longitude = view.findViewById(R.id.longitude);
			Longitude.setTypeface(face);
			LongitudeLabel = view.findViewById(R.id.longitudelabel);
			LongitudeLabel.setTypeface(face);
			Latitude = view.findViewById(R.id.latitude);
			Latitude.setTypeface(face);
			LatitudeLabel = view.findViewById(R.id.latitudelabel);
			LatitudeLabel.setTypeface(face);
			Common_city_fid = view.findViewById(R.id.common_city_fid);
			Common_city_fid.setTypeface(face);
			Common_city_fidLabel = view.findViewById(R.id.common_city_fidlabel);
			Common_city_fidLabel.setTypeface(face);
			Isactiveonphone = view.findViewById(R.id.isactiveonphone);
			Isactiveonphone.setTypeface(face);
			IsactiveonphoneLabel = view.findViewById(R.id.isactiveonphonelabel);
			IsactiveonphoneLabel.setTypeface(face);
			Isactiveonplace = view.findViewById(R.id.isactiveonplace);
			Isactiveonplace.setTypeface(face);
			IsactiveonplaceLabel = view.findViewById(R.id.isactiveonplacelabel);
			IsactiveonplaceLabel.setTypeface(face);
			Isactiveonhome = view.findViewById(R.id.isactiveonhome);
			Isactiveonhome.setTypeface(face);
			IsactiveonhomeLabel = view.findViewById(R.id.isactiveonhomelabel);
			IsactiveonhomeLabel.setTypeface(face);
			Photo_flu = view.findViewById(R.id.photo_flu);
			Photo_flu.setTypeface(face);
			Photo_fluLabel = view.findViewById(R.id.photo_flulabel);
			Photo_fluLabel.setTypeface(face);
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