package amsi.dei.estg.ipleiria.healthschedule.views;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.Toast;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterDiagnostico;
import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterReceitas;
import amsi.dei.estg.ipleiria.healthschedule.listeners.ReceitasListener;
import amsi.dei.estg.ipleiria.healthschedule.model.Medicamento;
import amsi.dei.estg.ipleiria.healthschedule.model.Receita;
import amsi.dei.estg.ipleiria.healthschedule.model.ReceitaMedicamento;
import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;
import amsi.dei.estg.ipleiria.healthschedule.utils.HospitalJsonParser;
import androidx.fragment.app.Fragment;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;


public class ListaReceitasFragment extends Fragment implements SwipeRefreshLayout.OnRefreshListener, ReceitasListener {
    private ListView lvListaReceitas;
    private SwipeRefreshLayout swipeRefreshLayout;
    private ArrayList<Receita> newreceitas, receitas;
    private int user_id;
    private ArrayList<ReceitaMedicamento> receitaMedicamentos;
    private ArrayList<Medicamento> medicamentos;


    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        View view = inflater.inflate(R.layout.fragment_lista_receitas, container, false);
        setHasOptionsMenu(true);


        lvListaReceitas= view.findViewById(R.id.lv_receita);


        swipeRefreshLayout= view.findViewById(R.id.swipe_refresh_layout);
        swipeRefreshLayout.setOnRefreshListener(this);
        SingletonGestorHospital.getInstance(getContext()).getAllMarcacaoAPI(getContext());
        SingletonGestorHospital.getInstance(getContext()).setReceitasListener(this);
        SingletonGestorHospital.getInstance(getContext()).getAllReceitasAPI(getContext());
        Bundle b3 = getArguments();
        user_id =b3.getInt("ID");

        return view;
    }

    @Override
    public void onResume() {
       receitas = SingletonGestorHospital.getInstance(getContext()).getAllReceitasBD();
       receitaMedicamentos = SingletonGestorHospital.getInstance(getContext()).getAllReceitaMedicamentoBD();
       medicamentos = SingletonGestorHospital.getInstance(getContext()).getAllMedicamentoBD();

        super.onResume();
    }

    @Override
    public void onRefresh() {
        SingletonGestorHospital.getInstance(getContext()).getAllReceitaMedicamentoAPI(getContext());
        SingletonGestorHospital.getInstance(getContext()).getAllMedicamentoAPI(getContext());
        SingletonGestorHospital.getInstance(getContext()).getAllReceitasAPI(getContext());
        swipeRefreshLayout.setRefreshing(false);
    }

    @Override
    public void onRefreshListaReceitas(ArrayList<Receita> receitas) {
       newreceitas = SingletonGestorHospital.getInstance(getContext()).getMarcacaReceita(receitas,user_id);
        lvListaReceitas.setAdapter(new AdapterReceitas(getContext(),newreceitas));
    }
}
