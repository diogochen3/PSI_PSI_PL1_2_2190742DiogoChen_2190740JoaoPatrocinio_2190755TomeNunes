package amsi.dei.estg.ipleiria.healthschedule.views;

import android.Manifest;
import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.media.MediaScannerConnection;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;

import amsi.dei.estg.ipleiria.healthschedule.listeners.ProfileListener;
import amsi.dei.estg.ipleiria.healthschedule.model.Profile;
import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;
import amsi.dei.estg.ipleiria.healthschedule.utils.HospitalJsonParser;
import androidx.annotation.Nullable;
import androidx.core.app.ActivityCompat;
import androidx.fragment.app.Fragment;

import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

import amsi.dei.estg.ipleiria.healthschedule.R;


public class PerfilFragment extends Fragment implements ProfileListener {

    private static final int EDITAR = 10;
    // public static final String ID = "ID";
    private TextView tvPNome, tvApelido, tvEmail, tvTelefone, tvNif, tvEndereco, tvDNascimento , tvgenero, tvcodPostal;
    private Button btnAlterar, btnLogout;
    private Profile perfil;
    private int id;

    private String currentPhotoPath;
    private ImageView imgProfile;

    public PerfilFragment() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_perfil, container, false);

        final Bundle b3 = getArguments();
        id =b3.getInt("ID");

        SingletonGestorHospital.getInstance(getContext()).getAllProfileAPI(getContext());
        //SharedPreferences sharedPreferences = getSharedPreferences(MenuMainActivity.TOKEN, Context.MODE_PRIVATE);
        // token = sharedPreferences.getString(MenuMainActivity.TOKEN, "sem email");

        tvPNome = view.findViewById(R.id.tvPNome);
        tvApelido = view.findViewById(R.id.tvLNome);
        tvEmail = view.findViewById(R.id.tvEmail);
        tvTelefone = view.findViewById(R.id.tvTelefone);
        tvNif = view.findViewById(R.id.tvNif);
        tvEndereco = view.findViewById(R.id.tvEndereco);
        tvDNascimento = view.findViewById(R.id.tvDNascimento);
        tvgenero = view.findViewById(R.id.tvGenero);
        tvcodPostal = view.findViewById(R.id.tvCodPostal);

        btnAlterar = view.findViewById(R.id.btnAlterar);
        btnLogout = view.findViewById(R.id.btnLogout);


        /// FloatingActionButton fab = findViewById(R.id.fab);

         SingletonGestorHospital.getInstance(getContext()).setProfileListener(this);


        btnLogout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                SharedPreferences preferences = getContext().getSharedPreferences(MenuMainActivity.USER, Context.MODE_PRIVATE);
                SharedPreferences.Editor editor = preferences.edit();
                editor.clear();
                editor.apply();
                Intent intent=new Intent(getContext(),LoginActivity.class);
                startActivity(intent);
            }
        });

        btnAlterar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent= new Intent(getContext(),AlterarProfileActivity.class);
                intent.putExtra("ID_USER", id);
                //startActivity(intent);
                startActivityForResult(intent,EDITAR);
            }
        });




        return view;
    }

    @Override
    public void onResume() {

        perfil = SingletonGestorHospital.getInstance(getContext()).getProfileBD(id);
        
        tvPNome.setText(perfil.getFirst_name());
        tvApelido.setText(perfil.getLast_name());
        tvEmail.setText(perfil.getEmail());
        tvTelefone.setText(String.valueOf(perfil.getPhone_number()));
        tvNif.setText(String.valueOf(perfil.getNIF()));
        tvEndereco.setText(perfil.getAddress());
        SimpleDateFormat formatter = new SimpleDateFormat("yyyy-MM-dd");//formating according to my need
        String date = formatter.format(perfil.getBirth_date());
        tvDNascimento.setText(date);
        tvgenero.setText(perfil.getGender());
        tvcodPostal.setText(perfil.getPostal_code());

        //tvPNome.setEnabled(false);
        tvApelido.setEnabled(false);
        tvEmail.setEnabled(false);
        tvTelefone.setEnabled(false);
        tvNif.setEnabled(false);
        tvEndereco.setEnabled(false);
        tvDNascimento.setEnabled(false);
        tvgenero.setEnabled(false);
        tvcodPostal.setEnabled(false);

        super.onResume();
    }


    @Override
    public void onRefreshListaProfiles(ArrayList<Profile> profiles) {

        perfil = SingletonGestorHospital.getInstance(getContext()).getProfile(id);
        tvPNome.setText(perfil.getFirst_name());
        tvApelido.setText(perfil.getLast_name());
        tvEmail.setText(perfil.getEmail());
        tvTelefone.setText(String.valueOf(perfil.getPhone_number()));
        tvNif.setText(String.valueOf(perfil.getNIF()));
        tvEndereco.setText(perfil.getAddress());
        SimpleDateFormat formatter = new SimpleDateFormat("yyyy-MM-dd");//formating according to my need
        String date = formatter.format(perfil.getBirth_date());
        tvDNascimento.setText(date);
        tvgenero.setText(perfil.getGender());
        tvcodPostal.setText(perfil.getPostal_code());


    }
    @Override
    public void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        if (resultCode== Activity.RESULT_OK){
            switch (requestCode){
                case EDITAR:
                    SingletonGestorHospital.getInstance(getContext()).getAllProfileAPI(getContext());
                    //lvListalivros.setAdapter(new ListaLivroAdaptador(getContext(),listaLivros));
                    Toast.makeText(getContext(),"Profile editado com sucesso",Toast.LENGTH_LONG);
                    //  Snackbar.make(getView(),"Livro editado com sucesso",Snackbar.LENGTH_LONG).show();
                    break;
            }
        }
        super.onActivityResult(requestCode, resultCode, data);
    }
    @Override
    public void onRefreshdetalhesProfiles() {
        //Toast.makeText(getContext(), "Foi editado com sucesso",Toast.LENGTH_LONG);
    }
}