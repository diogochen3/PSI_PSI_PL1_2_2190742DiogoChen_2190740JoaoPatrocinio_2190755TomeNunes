package amsi.dei.estg.ipleiria.healthschedule.views;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.Toast;

import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterDiagnostico;
import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterMarcacao;
import amsi.dei.estg.ipleiria.healthschedule.listeners.DiagnosticoListener;
import amsi.dei.estg.ipleiria.healthschedule.model.Diagnostico;
import amsi.dei.estg.ipleiria.healthschedule.model.Marcacao;
import amsi.dei.estg.ipleiria.healthschedule.model.Profile;
import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;
import androidx.fragment.app.Fragment;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

public class ListaDiagnosticosFragment extends Fragment implements SwipeRefreshLayout.OnRefreshListener, DiagnosticoListener {
    private ListView lvListaDiagnosticos;
    private ArrayList<Diagnostico> listaDiagnosticos, listaUserDiagnostico;

    private SwipeRefreshLayout swipeRefreshLayout;
    private int user_id;
    private ArrayList<Profile> profiles;
    @Override
    public void onRefreshListaDiagnostico(ArrayList<Diagnostico> diagnosticos) {

        listaUserDiagnostico= SingletonGestorHospital.getInstance(getContext()).getDiagnosticos(user_id,diagnosticos);
        lvListaDiagnosticos.setAdapter(new AdapterDiagnostico(getActivity(),listaUserDiagnostico,profiles));

    }

    @Override
    public void onRefreshdetalhesDiagnosticos() {

    }

    @Override
    public void onRefresh() {
        SingletonGestorHospital.getInstance(getContext()).getAllProfileAPI(getContext());
        SingletonGestorHospital.getInstance(getContext()).getAllDiagnosticoAPI(getContext());

        swipeRefreshLayout.setRefreshing(false);
    }
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        View view = inflater.inflate(R.layout.fragment_lista_diagnosticos, container, false);
        setHasOptionsMenu(true);
        Bundle b3 = getArguments();
        user_id =b3.getInt("ID");

        lvListaDiagnosticos= view.findViewById(R.id.lv_diagnostico);
        swipeRefreshLayout= view.findViewById(R.id.swipe_refresh_layout);

        swipeRefreshLayout.setOnRefreshListener(this);
        SingletonGestorHospital.getInstance(getContext()).setDiagnosticosListener(this);
        SingletonGestorHospital.getInstance(getContext()).getAllDiagnosticoAPI(getContext());

        /*listaDiagnosticos = SingletonGestorHospital.getInstance(getContext()).getallDiagnosticoBD();

        ArrayList<Diagnostico> listaUserDiagnostico = SingletonGestorHospital.getInstance(getContext()).getDiagnosticos(user_id,listaDiagnosticos);


        lvListaDiagnosticos.setAdapter(new AdapterDiagnostico(getActivity(),listaUserDiagnostico));*/

        return view;
    }

    public void onResume() {
        listaDiagnosticos = SingletonGestorHospital.getInstance(getContext()).getallDiagnosticoBD();
        listaUserDiagnostico = SingletonGestorHospital.getInstance(getContext()).getDiagnosticos(user_id,listaDiagnosticos);
        profiles = SingletonGestorHospital.getInstance(getContext()).getallProfileBD();
        lvListaDiagnosticos.setAdapter(new AdapterDiagnostico(getActivity(),listaUserDiagnostico,profiles));

        super.onResume();
    }

}
