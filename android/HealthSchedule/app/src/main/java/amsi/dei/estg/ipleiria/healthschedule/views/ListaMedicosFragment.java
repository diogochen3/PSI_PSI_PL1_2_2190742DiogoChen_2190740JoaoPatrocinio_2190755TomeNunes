package amsi.dei.estg.ipleiria.healthschedule.views;

import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

import amsi.dei.estg.ipleiria.healthschedule.R;


public class ListaMedicosFragment extends Fragment {

    private ListView lvListaMedicos;

    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_agenda, container, false);
        setHasOptionsMenu(true);


        lvListaMedicos= view.findViewById(R.id.lv_medico);
        // lvListaMarcacoes.setAdapter(new AdapterMarcacao(getContext(),listaMarcacoes));


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