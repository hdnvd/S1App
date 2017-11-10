<?php

namespace Modules\sfman\Controllers;

use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\SweetDate;
use Modules\common\PublicClasses\AppDate;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\sfman\Entity\sfman_formelementEntity;
use Modules\sfman\Entity\sfman_formelementtypeEntity;
use Modules\sfman\Entity\sfman_formEntity;
use Modules\sfman\Entity\sfman_moduleEntity;
use Modules\sfman\Entity\sfman_tableEntity;


/**
 * @author Hadi AmirNahavandi
 * @creationDate 1395/10/9 - 2016/12/29 19:36:38
 * @lastUpdate 1395/10/9 - 2016/12/29 19:36:38
 * @SweetFrameworkHelperVersion 1.112
 */
abstract class manageDBAndroidCodeController extends manageDBDesignFormController
{

    protected function makeAndroid_List_FragmentRecycler($formInfo)
    {

        $FormName = $formInfo['form']['name'];
        $UCFormName = ucwords($FormName);
        $fields = $this->getTableFields($this->getCodeModuleName() . "_" . $this->getTableName());
        $AllCount1 = count($fields);

        $FragmentName=$UCFormName . "Fragment";
        $ItemFragmentName=$UCFormName . "ItemFragment";
        $C = "package " . $this->getCodeModuleName() . ";";
        $C .= <<<EOT

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
EOT;

        $C .= "\r\npublic class " . ucwords($FormName) . "RecyclerViewAdapter extends RecyclerView.Adapter<" . ucwords($FormName) . "RecyclerViewAdapter.ViewHolder> {";
        $C .= "\r\n\tprivate final List<" . ucwords($FormName) . "> mValues;";
        $C .= "\r\n\tprivate final $FragmentName.OnListFragmentInteractionListener mListener;";
        $C .= "\r\n\tpublic MainActivity theActivity;";

        $C .= "\r\n\tpublic " . ucwords($FormName) . "RecyclerViewAdapter(List<" . ucwords($FormName) . "> items, $FragmentName.OnListFragmentInteractionListener listener) {";
        $C .= "\r\n\t\tmValues = items;";
        $C .= "\r\n\t\tmListener = listener;";
        $C .= "\r\n\t}";

        $C .= "\r\n\t@Override";
        $C .= "\r\n\t\tpublic ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {";
        $C .= "\r\n\t\t\tView view = LayoutInflater.from(parent.getContext()).inflate(R.layout.fragment_" . $FormName . ", parent, false);";
        $C .= "\r\n\t\t\treturn new ViewHolder(view);";
        $C .= "\r\n\t\t}";

        $C .= "\r\n\t@Override";
        $C .= "\r\n\t\tpublic void onBindViewHolder(final ViewHolder holder, int position) {";
        $C .= "\r\n\t\t\tholder.mItem = mValues.get(position);";
        $C .= "\r\n\t\t\tholder.mView.setOnClickListener(new View.OnClickListener() {";
        $C .= "\r\n\t\t\t\t@Override";
        $C .= "\r\n\t\t\t\tpublic void onClick(View v) {";
        $C .= "\r\n\t\t\t\t\ttheActivity.ItemID=holder.mItem.getId();";
        $C .= "\r\n\t\t\t\t\ttheActivity.showFragment($ItemFragmentName.class);";
        $C .= "\r\n\t\t\t\t}";
        $C .= "\r\n\t\t\t});";
        for ($i = 0; $i < $AllCount1; $i++) {
            $fl = $fields[$i];
            $ucFl = ucwords($fl);
            if ($fl != 'deletetime' && $fl != 'id') {
                $C .= "\r\n\t\t\tholder.$ucFl.setText(String.valueOf(mValues.get(position).get$ucFl()));";
            }
        }
        $C .= "\r\n\t\t}";

        $C .= "\r\n\t@Override";
        $C .= "\r\n\t\tpublic int getItemCount() {";
        $C .= "\r\n\t\t\treturn mValues.size();";
        $C .= "\r\n\t\t}";
        $C .= "\r\n\tpublic class ViewHolder extends RecyclerView.ViewHolder {";
        $C .= "\r\n\t\tpublic final View mView;";

        for ($i = 0; $i < $AllCount1; $i++) {
            $fl = $fields[$i];
            $ucFl = ucwords($fl);
            if ($fl != 'deletetime' && $fl != 'id') {
                $C .= "\r\n\t\tpublic final TextView $ucFl;";
                $C .= "\r\n\t\tpublic final TextView $ucFl" . "Label;";
            }
        }
        $C .= "\r\n\t\tpublic $UCFormName mItem;";
        $C .= "\r\n\t\tpublic ViewHolder(View view) {";
        $C .= "\r\n\t\t\tsuper(view);";
        $C .= "\r\n\t\t\tmView = view;";
        $C .= "\r\n\t\t\tTypeface face= Typeface.createFromAsset(theActivity.getAssets(),\"fonts/IRANSansMobile.ttf\");";
        for ($i = 0; $i < $AllCount1; $i++) {
            $fl = $fields[$i];
            $ucFl = ucwords($fl);
            if ($fl != 'deletetime' && $fl != 'id') {
                $C .= "\r\n\t\t\t$ucFl = view.findViewById(R.id.$fl);";
                $C .= "\r\n\t\t\t$ucFl.setTypeface(face);";
                $C .= "\r\n\t\t\t$ucFl" . "Label = view.findViewById(R.id.$fl" . "label);";
                $C .= "\r\n\t\t\t$ucFl" . "Label.setTypeface(face);";
            }
        }
        $C .= "\r\n\t\t}";
        $C .= "\r\n\t\t@Override";
        $C .= "\r\n\t\tpublic String toString() {";
        $C .= "\r\n\t\t\treturn super.toString();";
        $C .= "\r\n\t\t}";
        $C .= "\r\n\t}";
        $C .= "\t}";
        $HolderFile = $this->getAndroidCodeModuleDir() . "/" . ucwords($FormName) . "RecyclerViewAdapter.java";
        $this->SaveFile($HolderFile, $C);
    }
    protected function makeAndroid_List_Fragment($formInfo)
    {
        $FormName = $formInfo['form']['name'];
        $UCFormName = ucwords($FormName);
        $ListName =$UCFormName . "s";
        $fields = $this->getTableFields($this->getCodeModuleName() . "_" . $this->getTableName());
        $AllCount1 = count($fields);

        $C = "package " . $this->getCodeModuleName() . ";";
        $FragmentName=$UCFormName . "Fragment";

        $FragmentLayoutName="fragment_" . $FormName . "_list";
        $C.=<<<EOT

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
EOT;
        $C.="\r\nimport ".$this->getCodeModuleName(). ".$UCFormName;";

        $C.="\r\npublic class $FragmentName extends Fragment {";
        $C.="\r\n\tprivate static final String ARG_COLUMN_COUNT = \"column-count\";";
        $C.="\r\n\tprivate int mColumnCount = 1;";
        $C.="\r\n\tprivate OnListFragmentInteractionListener mListener;";
        $C.="\r\n\tprivate List<$UCFormName> $ListName;";
        $C.="\r\n\tprivate $UCFormName" . "RecyclerViewAdapter MainAdapter;";
        $C.="\r\n\tRecyclerView recyclerView;";

        $C.="\r\n\tpublic $FragmentName() {";
        $C.="\r\n\t\t$ListName=new ArrayList<$UCFormName>();";
        $C.="\r\n\t}";
        $C.="\r\n\tpublic static $FragmentName newInstance(int columnCount) {";
        $C.="\r\n\t\t$FragmentName fragment = new $FragmentName();";
        $C.="\r\n\t\tBundle args = new Bundle();";
        $C.="\r\n\t\targs.putInt(ARG_COLUMN_COUNT, columnCount);";
        $C.="\r\n\t\tfragment.setArguments(args);";
        $C.="\r\n\t\treturn fragment;";
        $C.="\r\n\t}";
        $C.=<<<EOT
@Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            mColumnCount = getArguments().getInt(ARG_COLUMN_COUNT);
        }
    }
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        View view = inflater.inflate(R.layout.$FragmentLayoutName, container, false);

        // Set the adapter
        if (view instanceof RecyclerView) {
            Context context = view.getContext();
            recyclerView = (RecyclerView) view;
            if (mColumnCount <= 1) {
                recyclerView.setLayoutManager(new LinearLayoutManager(context));
            } else {
                recyclerView.setLayoutManager(new GridLayoutManager(context, mColumnCount));
            }
EOT;

        $C.="\r\n\t\t\tMainAdapter=new $UCFormName" . "RecyclerViewAdapter(Products, mListener);";
        $C.="\r\n\t\t\tMainAdapter.theActivity=(MainActivity)getActivity();";
        $C.="\r\n\t\t\trecyclerView.setAdapter(MainAdapter);";
        $C.="\r\n\t\t}";
        $C.="\r\n\t\tAsyncTask.execute(new Runnable() {";
        $C.="\r\n\t\t@Override";
        $C.="\r\n\t\tpublic void run() {";
        $C.="\r\n\t\tnew $UCFormName(getActivity()).getAll($ListName);";
        $C.=<<<EOT
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
EOT;

    $C.="\r\n\tvoid onListFragmentInteraction($UCFormName item);";
        $C.="\r\n\t}";
        $C.="\r\n\t}";
        $HolderFile = $this->getAndroidCodeModuleDir() . "/$FragmentName.java";
        $this->SaveFile($HolderFile, $C);

    }
    protected function makeAndroid_List_FragmentLayout($formInfo)
    {

        $FormName = $formInfo['form']['name'];
        $UCFormName = ucwords($FormName);
        $fields = $this->getTableFields($this->getCodeModuleName() . "_" . $this->getTableName());
        $AllCount1 = count($fields);

        $FragmentName=$UCFormName . "Fragment";
        $FragmentLayoutName=$FormName . "_fragment";
        $C = "";
        $C .= <<<EOT
<?xml version="1.0" encoding="utf-8"?>
<android.support.v7.widget.RecyclerView xmlns:android="http://schemas.android.com/apk/res/android"
    xmlns:app="http://schemas.android.com/apk/res-auto"
    xmlns:tools="http://schemas.android.com/tools"
    android:id="@+id/list"
    android:name="ir.sweetsoft.onlineclass.onlineclass.ProductFragment"
    android:layout_width="match_parent"
    android:layout_height="match_parent"
    android:layout_marginLeft="16dp"
    android:layout_marginRight="16dp"
    android:layout_marginTop="45dp"
    app:layoutManager="LinearLayoutManager"
    tools:context="ir.sweetsoft.onlineclass.onlineclass.layout.$FragmentName"
    tools:listitem="@layout/$FragmentLayoutName" />

EOT;

        $HolderFile = $this->getAndroidCodeModuleDir() . "/fragment_" . $FormName . "_list.xml";
        $this->SaveFile($HolderFile, $C);
    }
    protected function makeAndroid_List_ItemFragmentLayout($formInfo)
    {

        $FormName = $formInfo['form']['name'];
        $UCFormName = ucwords($FormName);
        $fields = $this->getTableFields($this->getCodeModuleName() . "_" . $this->getTableName());
        $AllCount1 = count($fields);

        $C = "";
        $C .= <<<EOT
<?xml version="1.0" encoding="utf-8"?>
<android.support.v7.widget.CardView xmlns:android="http://schemas.android.com/apk/res/android"
    xmlns:card_view="http://schemas.android.com/apk/res-auto"
    android:layout_width="match_parent"
    android:layout_height="wrap_content"
    android:layout_marginTop="20dp"
    card_view:cardCornerRadius="4dp">
    <RelativeLayout
        android:layout_width="wrap_content"
        android:layout_height="wrap_content">

EOT;
        $lastFl = null;
        for ($i = 0; $i < $AllCount1; $i++) {
            $fl = $fields[$i];
            $ucFl = ucwords($fl);
            if ($fl != 'deletetime' && $fl != 'id') {
                $C .= "\r\n<TextView";
                $C .= "\r\nandroid:id=\"@+id/$fl" . "label\"";
                $C .= "\r\nandroid:layout_width=\"wrap_content\"";
                $C .= "\r\nandroid:layout_height=\"wrap_content\"";
                $C .= "\r\nandroid:layout_margin=\"@dimen/text_margin\"";
                $C .= "\r\nandroid:textAppearance=\"?attr/textAppearanceListItem\"";
                if ($lastFl == null)
                    $C .= "\r\nandroid:layout_alignParentTop=\"true\"";
                else
                    $C .= "\r\nandroid:layout_below=\"@id/$lastFl" . "label\"";
                $C .= "\r\nandroid:text=\"$ucFl:\"";
                $C .= "\r\nandroid:textColor=\"#333\"";
                $C .= "\r\nandroid:layout_alignParentRight=\"true\"";
                $C .= "\r\n/>";
                $C .= "\r\n<TextView";
                $C .= "\r\nandroid:id=\"@+id/$fl" . "\"";
                $C .= "\r\nandroid:layout_width=\"wrap_content\"";
                $C .= "\r\nandroid:layout_height=\"wrap_content\"";
                $C .= "\r\nandroid:layout_margin=\"@dimen/text_margin\"";
                $C .= "\r\nandroid:textAppearance=\"?attr/textAppearanceListItem\"";
                if ($lastFl == null)
                    $C .= "\r\nandroid:layout_alignParentTop=\"true\"";
                else
                    $C .= "\r\nandroid:layout_below=\"@id/$lastFl" . "label\"";
                $C .= "\r\nandroid:text=\"$ucFl\"";
                $C .= "\r\nandroid:textColor=\"#333\"";
                $C .= "\r\nandroid:layout_centerHorizontal=\"true\"";
                $C .= "\r\nandroid:layout_toLeftOf=\"@id/$fl" . "label\"";
                $C .= "\r\n/>";
                $lastFl = $fl;
            }

        }
        $C.=<<<EOT
        
</RelativeLayout>
</android.support.v7.widget.CardView>
EOT;
        $HolderFile = $this->getAndroidCodeModuleDir() . "/fragment_" . $FormName . ".xml";
        $this->SaveFile($HolderFile, $C);
    }

    protected function makeAndroidClass($formInfo)
    {
        $FormName = $formInfo['form']['name'];
        $UCFormName = ucwords($FormName);
        $C = "package " . $this->getCodeModuleName() . ";";
        $C .= "\r\nimport android.util.JsonReader;";
        $C .= "\r\nimport java.io.BufferedReader;";
        $C .= "\r\nimport java.io.IOException;";
        $C .= "\r\nimport java.io.InputStream;";
        $C .= "\r\nimport java.io.InputStreamReader;";
        $C .= "\r\nimport java.net.HttpURLConnection;";
        $C .= "\r\nimport java.net.MalformedURLException;";
        $C .= "\r\nimport java.net.ProtocolException;";
        $C .= "\r\nimport java.net.URL;";
        $C .= "\r\nimport common.SweetDeviceManager;";
        $C .= "\r\nimport common.RemoteClass;";
        $C .= "\r\nimport java.util.ArrayList;";
        $C .= "\r\nimport java.util.List;";
        $C .= "\r\nimport android.app.Activity;";
        $C .= "\r\npublic class " . ucwords($FormName) . " extends RemoteClass{";
        $C .= "\r\n\tpublic " . ucwords($FormName) . "(Activity activity){super(activity);}";
        $fields = $this->getTableFields($this->getCodeModuleName() . "_" . $this->getTableName());
        $AllCount1 = count($fields);
        for ($i = 0; $i < $AllCount1; $i++) {
            $fl = $fields[$i];
            if ($fl == 'id')
                $C .= "\n\tprivate long $fl;";
            elseif ($fl != 'deletetime')
                $C .= "\n\tprivate String $fl;";
        }
        $C .= "\n\tpublic void getAll(List<$UCFormName> $UCFormName" . "s){";
        $C .= "\n\t\ttry {";
        $C .= "\n\t\t\tString DeviceID= SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());";
        $C .= "\n\t\t\tString URL=Constants.SITEURL + \"json/fa/" . $this->getCodeModuleName() . "/" . $this->getTableName() . "list.jsp\";";
        $C .= "\n\t\t\tURL+=\"?deviceid=\"+DeviceID;";
        $C .= "\n\t\t\tJsonReader reader=getReader(URL);";
        $C .= "\n\t\t\tif(reader.hasNext()) {";
        $C .= "\n\t\t\treader.beginArray(); ";
        $C .= "\n\t\t\twhile (reader.hasNext())";
        $C .= "\n\t\t\t$UCFormName" . "s.add(getObject(reader));";
        $C .= "\n\t\treader.endArray();";
        $C .= "\n\t\t}";
        $C .= "\n\t\treturn;";
        $C .= "\n\t\t}catch (IOException e) {";
        $C .= "\n\t\te.printStackTrace();";
        $C .= "\n\t\t}";
        $C .= "\n\t\treturn;";
        $C .= "\n\t}";

        $C .= "\n\tpublic $UCFormName getOne(long Id)";
        $C .= "\n\t{";
        $C .= "\n\t\ttry {";
        $C .= "\n\t\t\tString DeviceID = SweetDeviceManager.getDeviceID(this.getActivity().getApplicationContext());";
        $C .= "\n\t\t\tString URL=Constants.SITEURL + \"json/fa/" . $this->getCodeModuleName() . "/" . $this->getTableName() . ".jsp\";";
        $C .= "\n\t\t\tURL+=\"?deviceid=\"+DeviceID+\"&id=\"+String.valueOf(Id);";
        $C .= "\n\t\t\tJsonReader reader=getReader(URL);";
        $C .= "\n\t\t\treturn getObject(reader);";
        $C .= "\n\t\t}catch (IOException e) {";
        $C .= "\n\t\te.printStackTrace();";
        $C .= "\n\t\t}";
        $C .= "\n\t\treturn null;";
        $C .= "\n\t}";

        $C .= "\n\tprivate $UCFormName getObject(JsonReader reader) throws IOException {";
        $C .= "\n\t\t\t\treader.beginObject();";
        $C .= "\n\t\t\t\t$UCFormName the" . $UCFormName . " =new $UCFormName(getActivity());";
        $C .= "\n\t\t\t\twhile (reader.hasNext()) {";
        $C .= "\n\t\t\t\t\tString key = reader.nextName();";
        $C .= "\n\t\t\t\t\tif (key.equals(\"id\")) {the" . $UCFormName . ".setId(reader.nextInt());}";
        for ($i = 0; $i < $AllCount1; $i++) {
            $fl = $fields[$i];
            if ($fl != 'deletetime' && $fl != 'id')
                $C .= "\n\t\t\t\t\telse if (key.equals(\"$fl\")) {the" . $UCFormName . ".set" . ucwords($fl) . "(reader.nextString());}";
        }
        $C .= "\n\t\t\t\t}";
        $C .= "\n\t\t\treader.endObject();";
        $C .= "\n\t\t\t\treturn the" . $UCFormName . ";";
        $C .= "\n\t}";

        $C .= "\n}";
        $DesignFile = $this->getAndroidCodeModuleDir() . "/" . ucwords($FormName) . ".java";
        $this->SaveFile($DesignFile, $C);
    }


    protected function makeAndroid_Item_Fragment($formInfo)
    {
        $FormName = $formInfo['form']['name'];
        $UCFormName = ucwords($FormName);
        $fields = $this->getTableFields($this->getCodeModuleName() . "_" . $this->getTableName());
        $AllCount1 = count($fields);

        $C = "package " . $this->getCodeModuleName() . ";";
        $FragmentName=$UCFormName . "ItemFragment";
        $FragmentLayoutName="fragment_" . $FormName . "_item";
        $C.=<<<EOT

import android.os.AsyncTask;
import android.content.Context;
import android.graphics.Typeface;
import android.net.Uri;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
EOT;
        $C.="\r\nimport ".$this->getCodeModuleName(). ".$UCFormName;";

        $C.="\r\npublic class $FragmentName extends Fragment {";
        $C.="\r\n\tprivate OnFragmentInteractionListener mListener;";
        $C.="\r\n\tprivate $UCFormName the". "$UCFormName;";
        for ($i = 0; $i < $AllCount1; $i++) {
            $fl = $fields[$i];
            $ucFl = ucwords($fl);
            if ($fl != 'deletetime' && $fl != 'id') {
                $C.="\r\n\tprivate TextView " . "lbl_".$ucFl. "Content;";
                $C.="\r\n\tprivate TextView " . "lbl_".$ucFl. "Caption;";
            }
        }

        $C.="\r\n\tpublic $FragmentName() {";
        $C.="\r\n\t}";
        $C.="\r\n\t@Override";
        $C.="\r\n\tpublic void onViewCreated(View view, @Nullable Bundle savedInstanceState) {";
        $C.="\r\n\tsuper.onViewCreated(view, savedInstanceState);";
        $C.="\r\n\tTypeface face= Typeface.createFromAsset(getActivity().getAssets(),\"fonts/IRANSansMobile.ttf\");";
        for ($i = 0; $i < $AllCount1; $i++) {
            $fl = $fields[$i];
            $ucFl = ucwords($fl);
            if ($fl != 'deletetime' && $fl != 'id') {
                $C.="\r\n\tlbl_".$ucFl. "Content=(TextView)getActivity().findViewById(R.id.lbl_".$fl."_content);";
                $C.="\r\n\tlbl_".$ucFl. "Caption=(TextView)getActivity().findViewById(R.id.lbl_".$fl."_caption);";
            }
        }
        for ($i = 0; $i < $AllCount1; $i++) {
            $fl = $fields[$i];
            $ucFl = ucwords($fl);
            if ($fl != 'deletetime' && $fl != 'id') {
                $C.="\r\n\tlbl_".$ucFl. "Content.setTypeface(face);";
                $C.="\r\n\tlbl_".$ucFl. "Caption.setTypeface(face);";
            }
        }
        $C.="\r\n\t}";

        $C.="\r\n\tprivate void ReloadData()";
        $C.="\r\n\t{";

        for ($i = 0; $i < $AllCount1; $i++) {
            $fl = $fields[$i];
            $ucFl = ucwords($fl);
            if ($fl != 'deletetime' && $fl != 'id') {
                $C.="\r\n\tlbl_".$ucFl. "Content.setText(the$UCFormName.get$ucFl());";
            }
        }
        $C.="\r\n\t}";

        $C.=<<<EOT
        
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        AsyncTask.execute(new Runnable() {
			@Override
			public void run() {
				the$UCFormName=new $UCFormName(getActivity()).getOne(((MainActivity)getActivity()).ItemID);
				getActivity().runOnUiThread(new Runnable() {
					@Override
					public void run() {
						ReloadData();
					}
				});
			}
		});
        View view = inflater.inflate(R.layout.$FragmentLayoutName, container, false);
        return view;
    }
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }
    @Override
    public void onAttach(Context context) {
        super.onAttach(context);
        if (context instanceof OnFragmentInteractionListener) {
            mListener = (OnFragmentInteractionListener) context;
        }
    }
    @Override
    public void onDetach() {
        super.onDetach();
        mListener = null;
    }
    public interface OnFragmentInteractionListener {
        void onFragmentInteraction(Uri uri);
    }
  }
EOT;
    
        $HolderFile = $this->getAndroidCodeModuleDir() . "/$FragmentName.java";
        $this->SaveFile($HolderFile, $C);

    }
    protected function makeAndroid_Item_FragmentLayout($formInfo)
    {

        $FormName = $formInfo['form']['name'];
        $UCFormName = ucwords($FormName);
        $fields = $this->getTableFields($this->getCodeModuleName() . "_" . $this->getTableName());
        $AllCount1 = count($fields);

        $C = "";
        $C .= <<<EOT
<?xml version="1.0" encoding="utf-8"?>
    <RelativeLayout xmlns:android="http://schemas.android.com/apk/res/android"
        android:layout_width="match_parent"
        android:layout_height="wrap_content"
    android:layout_marginTop="65dp">
EOT;
        $lastFl = null;
        for ($i = 0; $i < $AllCount1; $i++) {
            $fl = $fields[$i];
            $ucFl = ucwords($fl);
            if ($fl != 'deletetime' && $fl != 'id') {
                $C .= "\r\n<TextView";
                $C .= "\r\nandroid:id=\"@+id/lbl_$fl" . "_caption\"";
                $C .= "\r\nandroid:layout_width=\"wrap_content\"";
                $C .= "\r\nandroid:layout_height=\"wrap_content\"";
                $C .= "\r\nandroid:layout_margin=\"@dimen/text_margin\"";
                $C .= "\r\nandroid:textAppearance=\"?attr/textAppearanceListItem\"";
                if ($lastFl == null)
                    $C .= "\r\nandroid:layout_alignParentTop=\"true\"";
                else
                    $C .= "\r\nandroid:layout_below=\"@id/lbl_$lastFl" . "_caption\"";
                $C .= "\r\nandroid:text=\"$ucFl:\"";
                $C .= "\r\nandroid:textColor=\"#333\"";
                $C .= "\r\nandroid:layout_alignParentRight=\"true\"";
                $C .= "\r\n/>";
                $C .= "\r\n<TextView";
                $C .= "\r\nandroid:id=\"@+id/lbl_$fl" . "_content\"";
                $C .= "\r\nandroid:layout_width=\"wrap_content\"";
                $C .= "\r\nandroid:layout_height=\"wrap_content\"";
                $C .= "\r\nandroid:layout_margin=\"@dimen/text_margin\"";
                $C .= "\r\nandroid:textAppearance=\"?attr/textAppearanceListItem\"";
                if ($lastFl == null)
                    $C .= "\r\nandroid:layout_alignParentTop=\"true\"";
                else
                    $C .= "\r\nandroid:layout_below=\"@id/lbl_$lastFl" . "_content\"";
                $C .= "\r\nandroid:text=\"$ucFl\"";
                $C .= "\r\nandroid:textColor=\"#333\"";
                $C .= "\r\nandroid:layout_centerHorizontal=\"true\"";
                $C .= "\r\nandroid:layout_toLeftOf=\"@id/lbl_$fl" . "_caption\"";
                $C .= "\r\n/>";
                $lastFl = $fl;
            }

        }
        $C.=<<<EOT
        
</RelativeLayout>
EOT;
        $HolderFile = $this->getAndroidCodeModuleDir() . "/fragment_" . $FormName . "_item.xml";
        $this->SaveFile($HolderFile, $C);
    }
}

?>
