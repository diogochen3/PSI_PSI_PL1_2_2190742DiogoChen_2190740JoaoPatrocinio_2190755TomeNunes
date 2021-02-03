package amsi.dei.estg.ipleiria.healthschedule.views;

import android.os.Bundle;

import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterMarcacao;
import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterMedicos;
import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterNomeMedicos;
import amsi.dei.estg.ipleiria.healthschedule.listeners.EspecialidadeListener;
import amsi.dei.estg.ipleiria.healthschedule.listeners.MarcacoesListener;
import amsi.dei.estg.ipleiria.healthschedule.listeners.MedicoEspecialidadeListener;
import amsi.dei.estg.ipleiria.healthschedule.model.Especialidade;
import amsi.dei.estg.ipleiria.healthschedule.model.Marcacao;
import amsi.dei.estg.ipleiria.healthschedule.model.MedicoEspecialidade;
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


public class ListaMedicosFragment extends Fragment implements EspecialidadeListener, MedicoEspecialidadeListener {

    private ListView lvListaMedicos;
    private ArrayList<Profile> medico;
    private ArrayList<Especialidade> especialidades;
    private ArrayList<MedicoEspecialidade> medicoEspecialidades;

    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_agenda, container, false);
        setHasOptionsMenu(true);

        SingletonGestorHospital.getInstance(getContext()).setEspecialidadeListener(this);

        SingletonGestorHospital.getInstance(getContext()).setMedicoEspecialidadeListener(this);



        lvListaMedicos= view.findViewById(R.id.lv_medico);
        SingletonGestorHospital.getInstance(getContext()).getAllEspecialidadeAPI(getContext());
        SingletonGestorHospital.getInstance(getContext()).getAllMedicoEspecialidadeAPI(getContext());

        medico = SingletonGestorHospital.getInstance(getContext()).getallProfileBD();
       /* especialidades = SingletonGestorHospital.getInstance(getContext()).getallEspecialidadeBD();
        medicoEspecialidades = SingletonGestorHospital.getInstance(getContext()).getallMedicoEspecialidadeBD();*/

        if(medico != null && especialidades != null && medicoEspecialidades != null){
            lvListaMedicos.setAdapter(new AdapterMedicos(getContext(),medico,especialidades,medicoEspecialidades));

    }






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

    @Override
    public void onRefreshListaEspecialidade(ArrayList<Especialidade> especialidades1) {
        especialidades = especialidades1;

    }

    @Override
    public void onRefreshListaMedicoEspecialidade(ArrayList<MedicoEspecialidade> medicoEspecialidade) {
        medicoEspecialidades = medicoEspecialidade;


    }
}