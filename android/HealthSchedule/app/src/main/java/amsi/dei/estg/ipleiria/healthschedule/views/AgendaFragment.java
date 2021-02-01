package amsi.dei.estg.ipleiria.healthschedule.views;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.SearchView;
import android.widget.Toast;

import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterMarcacao;
import amsi.dei.estg.ipleiria.healthschedule.listeners.MarcacoesListener;
import amsi.dei.estg.ipleiria.healthschedule.model.Marcacao;
import amsi.dei.estg.ipleiria.healthschedule.model.Profile;
import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;
import amsi.dei.estg.ipleiria.healthschedule.utils.HospitalJsonParser;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import com.google.android.material.floatingactionbutton.FloatingActionButton;


public class AgendaFragment extends Fragment implements SwipeRefreshLayout.OnRefreshListener, MarcacoesListener {
    private ListView lvListaMarcacoes;
    private static final int EDITAR=2;
    private static final int ADICIONAR=1;
    private int user_id;
    private SwipeRefreshLayout swipeRefreshLayout;
    private ArrayList<Profile> medico;
    private ArrayList<Marcacao> listaMarcacoes;

    public AgendaFragment() {

    }




    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_agenda, container, false);
        setHasOptionsMenu(true);


        lvListaMarcacoes= view.findViewById(R.id.lv_agenda);
        Bundle b3 = getArguments();
        user_id =b3.getInt("ID");
       // lvListaMarcacoes.setAdapter(new AdapterMarcacao(getContext(),listaMarcacoes));
        swipeRefreshLayout= view.findViewById(R.id.swipe_refresh_layout);
        swipeRefreshLayout.setOnRefreshListener(this);

        lvListaMarcacoes.setOnItemClickListener(new AdapterView.OnItemClickListener() {

            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                //Toast.makeText(getContext(),"Livro com o id="+l,Toast.LENGTH_LONG).show();
                Intent intent=new Intent(getContext(),MarcacaoActivity.class);
                intent.putExtra("ID",(int) id);

                //startActivity(intent);
                startActivityForResult(intent,EDITAR);

            }
        });
        FloatingActionButton fab= view.findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                if(HospitalJsonParser.isConnectionInternet(getContext())){
                    Intent intent= new Intent(getContext(),MarcacaoActivity.class);
                    intent.putExtra("ID_USER",(int) user_id);
                    //startActivity(intent);
                    startActivityForResult(intent,ADICIONAR);
                }
            }
        });

        SingletonGestorHospital.getInstance(getContext()).setMarcacaoListener(this);
        SingletonGestorHospital.getInstance(getContext()).getAllMarcacaoAPI(getContext());

      /*  if (listaMarcacoes != null){
            lvListaMarcacoes.setAdapter(new AdapterMarcacao(getActivity(),listaMarcacoes));
        }else{
            Toast.makeText(getContext(), "FODASE", Toast.LENGTH_SHORT).show();
        }*/

        return view;


    }


    @Override
    public void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        if (resultCode== Activity.RESULT_OK){
            switch (resultCode){
                case ADICIONAR:
                    SingletonGestorHospital.getInstance(getContext()).getAllMarcacaoAPI(getContext());
                    //lvListalivros.setAdapter(new ListaLivroAdaptador(getContext(),listaLivros));
                    Toast.makeText(getContext(),"Marcacao adicionado com sucesso",Toast.LENGTH_LONG);
                    //  Snackbar.make(getView(),"Livro adicionado com sucesso",Snackbar.LENGTH_LONG).show();
                    break;
                case EDITAR:
                    SingletonGestorHospital.getInstance(getContext()).getAllMarcacaoAPI(getContext());
                    //lvListalivros.setAdapter(new ListaLivroAdaptador(getContext(),listaLivros));
                    Toast.makeText(getContext(),"Livro editado com sucesso",Toast.LENGTH_LONG);
                    //  Snackbar.make(getView(),"Livro editado com sucesso",Snackbar.LENGTH_LONG).show();
                    break;
            }
        }
        super.onActivityResult(requestCode, resultCode, data);
    }


    @Override
    public void onResume() {
        listaMarcacoes = SingletonGestorHospital.getInstance(getContext()).getallMarcacaoBD();
        medico = SingletonGestorHospital.getInstance(getContext()).getallProfileBD();
        listaMarcacoes = SingletonGestorHospital.getInstance(getContext()).getMarcacoes(user_id,listaMarcacoes);
        lvListaMarcacoes.setAdapter(new AdapterMarcacao(getActivity(),listaMarcacoes, medico));
       // SingletonGestorHospital.getInstance(getContext()).getAllMarcacaoAPI(getContext());
        super.onResume();
    }
    @Override
    public void onRefresh() {
        SingletonGestorHospital.getInstance(getContext()).getAllMarcacaoAPI(getContext());
        swipeRefreshLayout.setRefreshing(false);
        //Toast.makeText(getContext(),"Toquei no refresh",Toast.LENGTH_SHORT).show();
    }

    @Override
    public void onRefreshListaMarcacoes(ArrayList<Marcacao> marcacoes) {
        medico = SingletonGestorHospital.getInstance(getContext()).getallProfileBD();
        listaMarcacoes = SingletonGestorHospital.getInstance(getContext()).getMarcacoes(user_id,marcacoes);
        lvListaMarcacoes.setAdapter(new AdapterMarcacao(getContext(),listaMarcacoes,medico));
    }

    @Override
    public void onRefreshdetalhesLivros() {

    }
}