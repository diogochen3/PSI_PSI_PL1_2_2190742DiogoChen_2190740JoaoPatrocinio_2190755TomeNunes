package amsi.dei.estg.ipleiria.healthschedule.views;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;

import amsi.dei.estg.ipleiria.healthschedule.listeners.ProfileListener;
import amsi.dei.estg.ipleiria.healthschedule.model.Profile;
import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;
import amsi.dei.estg.ipleiria.healthschedule.utils.HospitalJsonParser;
import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

import amsi.dei.estg.ipleiria.healthschedule.R;


public class PerfilFragment extends Fragment implements ProfileListener {

   // public static final String ID = "ID";
    private TextView etPNome, etApelido, etEmail, etTelefone, etNif, etEndereco, etDNascimento , etgenero, etcodPostal;
    private Button btnAlterar, btnLogout;
    private Profile perfil;
    private int id;

    public PerfilFragment() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_perfil, container, false);

        Bundle b3 = getArguments();
        id =b3.getInt("ID");

        //SharedPreferences sharedPreferences = getSharedPreferences(MenuMainActivity.TOKEN, Context.MODE_PRIVATE);
        // token = sharedPreferences.getString(MenuMainActivity.TOKEN, "sem email");

        etPNome = view.findViewById(R.id.etPNome);
        etApelido = view.findViewById(R.id.etLNome);
        etEmail = view.findViewById(R.id.etEmail);
        etTelefone = view.findViewById(R.id.etTelefone);
        etNif = view.findViewById(R.id.etNif);
        etEndereco = view.findViewById(R.id.etEndereco);
        etDNascimento = view.findViewById(R.id.etDNascimento);
        etgenero = view.findViewById(R.id.etGenero);
        etcodPostal = view.findViewById(R.id.etCodPostal);

        btnAlterar = view.findViewById(R.id.btnAlterar);
        btnLogout = view.findViewById(R.id.btnLogout);

        perfil = SingletonGestorHospital.getInstance(getContext()).getProfile(id);

        /// FloatingActionButton fab = findViewById(R.id.fab);

        // SingletonGestorLivros.getInstance(getApplicationContext()).setLivrosListener(this);

        if (perfil != null){
            //"Perfil: "+perfil.getpNome() + perfil.getApelido());
            carregarPerfil();
            //fab.setImageResource(R.drawable.ic_action_guardar);
        }else{

            //setTitle("Adicionar Livro");
            //fab.setImageResource(R.drawable.ic_action_adicionar);
        }

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
                if(HospitalJsonParser.isConnectionInternet(getContext())){
                    SimpleDateFormat formatter = new SimpleDateFormat("yyyy-MM-dd");
                    Date date = null;
                    try {
                        date = formatter.parse(etDNascimento.getText().toString());
                    } catch (ParseException e) {
                        e.printStackTrace();
                    }
                    perfil.setFirst_name(etPNome.getText().toString());
                    perfil.setLast_name(etApelido.getText().toString());
                    perfil.setEmail(etEmail.getText().toString());
                    perfil.setPhone_number(Integer.parseInt(etTelefone.getText().toString()));
                    perfil.setNIF(Integer.parseInt(etNif.getText().toString()));
                    perfil.setAddress(etEndereco.getText().toString());
                    perfil.setBirth_date(date);
                    perfil.setGender(etgenero.getText().toString());
                    perfil.setPostal_code(etcodPostal.getText().toString());

                    SingletonGestorHospital.getInstance(getContext()).editarProfileAPI(perfil,getContext());
                }

            }
        });

        return view;
    }



    private void carregarPerfil() {
        etPNome.setText(perfil.getFirst_name());
        etApelido.setText(perfil.getLast_name());
        etEmail.setText(perfil.getEmail());
        etTelefone.setText(String.valueOf(perfil.getPhone_number()));
        etNif.setText(String.valueOf(perfil.getNIF()));
        etEndereco.setText(perfil.getAddress());
        SimpleDateFormat formatter = new SimpleDateFormat("yyyy-MM-dd");//formating according to my need
        String date = formatter.format(perfil.getBirth_date());
        etDNascimento.setText(date);
        etgenero.setText(perfil.getGender());
        etcodPostal.setText(perfil.getPostal_code());

        //etPNome.setEnabled(false);
        etApelido.setEnabled(false);
        etEmail.setEnabled(false);
        etTelefone.setEnabled(false);
        etNif.setEnabled(false);
        etEndereco.setEnabled(false);
        etDNascimento.setEnabled(false);
        etgenero.setEnabled(false);
        etcodPostal.setEnabled(false);
    }


    @Override
    public void onRefreshListaProfiles(ArrayList<Profile> profiles) {
        
    }

    @Override
    public void onRefreshdetalhesProfiles() {
        Toast.makeText(getContext(), "Foi editado com sucesso",Toast.LENGTH_LONG);
    }
}