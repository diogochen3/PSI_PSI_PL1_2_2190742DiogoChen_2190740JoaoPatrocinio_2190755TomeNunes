package amsi.dei.estg.ipleiria.healthschedule.views;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;

import amsi.dei.estg.ipleiria.healthschedule.model.Profile;
import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;
import amsi.dei.estg.ipleiria.healthschedule.utils.HospitalJsonParser;
import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.text.SimpleDateFormat;

import amsi.dei.estg.ipleiria.healthschedule.R;


public class PerfilFragment extends Fragment {


    public static final String ID = "ID";
    private TextView tvPNome, tvApelido, tvEmail, tvTelefone, tvNif, tvEndereco, tvDNascimento , tvgenero;

    private Profile perfil;
    private int id = 6;
    private String token;

    public PerfilFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_perfil, container, false);




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
        tvPNome.setText(perfil.getpNome());
        tvApelido.setText(perfil.getApelido());
        tvEmail.setText(perfil.getEmail());
        tvTelefone.setText(perfil.getTelefone());
        tvNif.setText(perfil.getNif());
        tvEndereco.setText(perfil.getEndereco());
        SimpleDateFormat formatter = new SimpleDateFormat("yyyy-MM-dd");//formating according to my need
        String date = formatter.format(perfil.getDataNascimento());
        tvDNascimento.setText(date);
        tvgenero.setText(perfil.getGenero());

    }

}