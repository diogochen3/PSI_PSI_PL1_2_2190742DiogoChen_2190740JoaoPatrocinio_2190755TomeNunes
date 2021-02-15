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


public class ListaMedicosFragment extends Fragment {

    private ListView lvListaMedicos;
    private ArrayList<Profile> medico;
    private ArrayList<Especialidade> especialidades;
    private ArrayList<MedicoEspecialidade> medicoEspecialidades;

    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_lista_medicos, container, false);
        setHasOptionsMenu(true);


        lvListaMedicos= view.findViewById(R.id.lv_medicossssss);

        medico = SingletonGestorHospital.getInstance(getContext()).getMedicosEspecialidade();

        especialidades = SingletonGestorHospital.getInstance(getContext()).getallEspecialidadeBD();
        medicoEspecialidades = SingletonGestorHospital.getInstance(getContext()).getallMedicoEspecialidadeBD();

        lvListaMedicos.setAdapter(new AdapterMedicos(getContext(),medico));




        return view;


    }

    public void onResume() {
        medico = SingletonGestorHospital.getInstance(getContext()).getMedicosEspecialidade();
        especialidades = SingletonGestorHospital.getInstance(getContext()).getallEspecialidadeBD();
        medicoEspecialidades = SingletonGestorHospital.getInstance(getContext()).getallMedicoEspecialidadeBD();

        lvListaMedicos.setAdapter(new AdapterMedicos(getContext(),medico));


        super.onResume();
    }




}