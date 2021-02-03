package amsi.dei.estg.ipleiria.healthschedule.views;

import android.os.Bundle;

import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterMarcacao;
import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterNomeMedicos;
import amsi.dei.estg.ipleiria.healthschedule.model.Marcacao;
import amsi.dei.estg.ipleiria.healthschedule.model.Profile;
import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;
import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.R;


public class ListaMedicosFragment extends Fragment {

    private ListView lvListaMedicos;
    private ArrayList<Profile> medico;
    private ArrayList<Profile> listamedicos;

    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_agenda, container, false);
        setHasOptionsMenu(true);


<<<<<<< Updated upstream
        lvListaMedicos= view.findViewById(R.id.lv_medico);
        // lvListaMarcacoes.setAdapter(new AdapterMarcacao(getContext(),listaMarcacoes));
=======
        lvListaMedicos= view.findViewById(R.id.lv_agenda);
        medico = SingletonGestorHospital.getInstance(getContext()).getallProfileBD();
        lvListaMedicos.setAdapter(new AdapterNomeMedicos(getContext(),listamedicos));
>>>>>>> Stashed changes


        lvListaMedicos.setOnItemClickListener(new AdapterView.OnItemClickListener() {

            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {


            }
        });
        FloatingActionButton fab= view.findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
            }
        });


        return view;


    }
}