package amsi.dei.estg.ipleiria.healthschedule.views;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;

import amsi.dei.estg.ipleiria.healthschedule.model.Profile;
import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;
import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;

import java.text.SimpleDateFormat;

import amsi.dei.estg.ipleiria.healthschedule.R;


public class PerfilFragment extends Fragment {

   // public static final String ID = "ID";
    private TextView tvPNome, tvApelido, tvEmail, tvTelefone, tvNif, tvEndereco, tvDNascimento , tvgenero, tvcodPostal;
    private Button btnTime, btnLogout;
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

        tvPNome = view.findViewById(R.id.tvPNome);
        tvApelido = view.findViewById(R.id.tvLNome);
        tvEmail = view.findViewById(R.id.tvEmail);
        tvTelefone = view.findViewById(R.id.tvTelefone);
        tvNif = view.findViewById(R.id.tvNif);
        tvEndereco = view.findViewById(R.id.tvEndereco);
        tvDNascimento = view.findViewById(R.id.tvDNascimento);
        tvgenero = view.findViewById(R.id.tvGenero);
        tvcodPostal = view.findViewById(R.id.tvCodPostal);
        btnTime = view.findViewById(R.id.btnAlterar);
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

      /*  fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(LivroJsonParser.isConnectionInternet(getApplicationContext())){
                    if (livro!=null)
                        if (validarLivro()==true){
                            livro.setTitulo(etTitulo.getText().toString());
                            livro.setSerie(etSerie.getText().toString());
                            livro.setAutor(etAutor.getText().toString());
                            livro.setAno(Integer.parseInt(etAno.getText().toString()));
                            SingletonGestorLivros.getInstance(getApplicationContext()).editarLivroAPI(livro,getApplicationContext(),token);
                        }else return;
                    else
                    if (validarLivro()==true){
                        livro = new Livro(0,Integer.parseInt(etAno.getText().toString()),"http://amsi.dei.estg.ipleiria.pt/img/ipl_semfundo.png",etTitulo.getText().toString(),etSerie.getText().toString(),etAutor.getText().toString());
                        SingletonGestorLivros.getInstance(getApplicationContext()).adicionarLivroAPI(livro,getApplicationContext(),token);
                    }else return;
                    // setResult(RESULT_OK);
                    //finish();
                }

            }
        });*/
        return view;
    }



    private void carregarPerfil() {
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


}