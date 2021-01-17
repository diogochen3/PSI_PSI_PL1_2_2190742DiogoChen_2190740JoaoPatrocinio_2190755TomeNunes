package amsi.dei.estg.ipleiria.healthschedule.views;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.SearchView;

import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.listeners.MarcacoesListener;
import amsi.dei.estg.ipleiria.healthschedule.model.Marcacao;
import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;
import androidx.fragment.app.Fragment;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import com.google.android.material.floatingactionbutton.FloatingActionButton;


public class AgendaFragment extends Fragment implements SwipeRefreshLayout.OnRefreshListener {
    private ListView lvListaMarcacoes;
    private MarcacoesListener marcacoesListener;
    private static final int EDITAR=2;
    private static final int ADICIONAR=1;
    private ArrayList<Marcacao> listaLivros;
    private SearchView searchView;
    private SwipeRefreshLayout swipeRefreshLayout;
    public AgendaFragment() {

    }




    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_agenda, container, false);
        setHasOptionsMenu(true);


        lvListaMarcacoes= view.findViewById(R.id.lv_agenda);

        swipeRefreshLayout= view.findViewById(R.id.swipe_refresh_layout);
        swipeRefreshLayout.setOnRefreshListener(this);

        lvListaMarcacoes.setOnItemClickListener(new AdapterView.OnItemClickListener() {

            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                //Toast.makeText(getContext(),"Livro com o id="+l,Toast.LENGTH_LONG).show();
                //Intent intent=new Intent(getContext(),DetalhesLivroActivity.class);
               // intent.putExtra("ID",(int) id);
                //startActivity(intent);
                //startActivityForResult(intent,EDITAR);

            }
        });
        FloatingActionButton fab= view.findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                //if(LivroJsonParser.isConnectionInternet(getContext())){
                  //  Intent intent= new Intent(getContext(),DetalhesLivroActivity.class);
                    //startActivity(intent);
                 //   startActivityForResult(intent,ADICIONAR);
               // }
            }
        });
        SingletonGestorHospital.getInstance(getContext()).setMarcacaoListener(marcacoesListener);
        SingletonGestorHospital.getInstance(getContext()).getAllMarcacaoAPI(getContext());
        return view;


    }

    @Override
    public void onRefresh() {
        SingletonGestorHospital.getInstance(getContext()).getAllMarcacaoAPI(getContext());
        swipeRefreshLayout.setRefreshing(false);
        //Toast.makeText(getContext(),"Toquei no refresh",Toast.LENGTH_SHORT).show();
    }
}