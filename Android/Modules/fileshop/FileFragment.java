package fileshop;
import android.content.Context;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.widget.GridLayoutManager;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import java.util.ArrayList;
import java.util.List;
import fileshop.File;
public class FileFragment extends Fragment {
	private static final String ARG_COLUMN_COUNT = "column-count";
	private int mColumnCount = 1;
	private OnListFragmentInteractionListener mListener;
	private List<File> Files;
	private FileRecyclerViewAdapter MainAdapter;
	RecyclerView recyclerView;
	public FileFragment() {
		Files=new ArrayList<File>();
	}
	public static FileFragment newInstance(int columnCount) {
		FileFragment fragment = new FileFragment();
		Bundle args = new Bundle();
		args.putInt(ARG_COLUMN_COUNT, columnCount);
		fragment.setArguments(args);
		return fragment;
	}@Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            mColumnCount = getArguments().getInt(ARG_COLUMN_COUNT);
        }
    }
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        View view = inflater.inflate(R.layout.fragment_file_list, container, false);

        // Set the adapter
        if (view instanceof RecyclerView) {
            Context context = view.getContext();
            recyclerView = (RecyclerView) view;
            if (mColumnCount <= 1) {
                recyclerView.setLayoutManager(new LinearLayoutManager(context));
            } else {
                recyclerView.setLayoutManager(new GridLayoutManager(context, mColumnCount));
            }
			MainAdapter=new FileRecyclerViewAdapter(Files, mListener);
			MainAdapter.theActivity=(MainActivity)getActivity();
			recyclerView.setAdapter(MainAdapter);
		}
		AsyncTask.execute(new Runnable() {
		@Override
		public void run() {
		new File(getActivity()).getAll(Files);        
            getActivity().runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
        MainAdapter.notifyDataSetChanged();

                    }
                });
            }
        });
        return view;
    }
    @Override
    public void onAttach(Context context) {
        super.onAttach(context);
        if (context instanceof OnListFragmentInteractionListener) {
            mListener = (OnListFragmentInteractionListener) context;
        } else {
        }
    }

    @Override
    public void onDetach() {
    super.onDetach();
        mListener = null;
    }
    public interface OnListFragmentInteractionListener {
	void onListFragmentInteraction(File item);
	}
	}