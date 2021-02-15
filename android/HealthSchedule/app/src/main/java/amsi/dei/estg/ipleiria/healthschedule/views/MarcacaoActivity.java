package amsi.dei.estg.ipleiria.healthschedule.views;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterEspecialidade;
import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterHorario;
import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterMarcacao;
import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterNomeMedicos;
import amsi.dei.estg.ipleiria.healthschedule.listeners.EspecialidadeListener;
import amsi.dei.estg.ipleiria.healthschedule.listeners.MarcacoesListener;
import amsi.dei.estg.ipleiria.healthschedule.listeners.MedicoEspecialidadeListener;
import amsi.dei.estg.ipleiria.healthschedule.model.Especialidade;
import amsi.dei.estg.ipleiria.healthschedule.model.Horario;
import amsi.dei.estg.ipleiria.healthschedule.model.Marcacao;
import amsi.dei.estg.ipleiria.healthschedule.model.MedicoEspecialidade;
import amsi.dei.estg.ipleiria.healthschedule.model.Profile;
import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;
import amsi.dei.estg.ipleiria.healthschedule.utils.HospitalJsonParser;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.cardview.widget.CardView;

import android.app.AlertDialog;
import android.app.TimePickerDialog;
import android.content.DialogInterface;
import android.os.Build;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemSelectedListener;
import android.widget.ArrayAdapter;
import android.widget.CalendarView;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.TimePicker;
import android.widget.Toast;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.security.AccessController;
import java.sql.Time;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;

public class MarcacaoActivity extends AppCompatActivity  implements MarcacoesListener, EspecialidadeListener, MedicoEspecialidadeListener {

    public static final String ID = "ID";
    private static final String ID_USER = "ID_USER";
    private Marcacao marcacao;
    private int id_especialidade, id_medico, id_horario;
    private ArrayList<MedicoEspecialidade> medicoEspecialidades;
    private Spinner spMedico, spEspecialidade, spHorario;
    private ArrayAdapter arrayAdapter;
    private ArrayList<Especialidade> especialidade;
    private ArrayList<Profile> medico;
    private TextView tvEspecialidade, tvMedico, txtEspecialidade, txtMedico;
    private ArrayList<Horario> horarios;
    private Horario antiHorario, atualHorario;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_marcacao);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        final int id = getIntent().getIntExtra(ID,0);
        final int id_user = getIntent().getIntExtra(ID_USER,0);
        marcacao = SingletonGestorHospital.getInstance(getApplicationContext()).getMarcacao(id);

        SingletonGestorHospital.getInstance(getApplicationContext()).setMedicoEspecialidadeListener(this);
        SingletonGestorHospital.getInstance(getApplicationContext()).setEspecialidadeListener(this);

        SingletonGestorHospital.getInstance(getApplicationContext()).setMarcacaoListener(this);

        SingletonGestorHospital.getInstance(getApplicationContext()).getAllMedicoEspecialidadeAPI(getApplicationContext());
        SingletonGestorHospital.getInstance(getApplicationContext()).getAllEspecialidadeAPI(getApplicationContext());
        SingletonGestorHospital.getInstance(getApplicationContext()).getAllHorarioAPI(getApplicationContext());

        final FloatingActionButton fab = findViewById(R.id.fab);
        spEspecialidade = findViewById(R.id.spEspecialidade);
        spMedico = findViewById(R.id.spMedico);
        spHorario = findViewById(R.id.spHorario);
        tvEspecialidade = findViewById(R.id.tvEspecialidade);
        tvMedico = findViewById(R.id.tvMedico);
        txtEspecialidade = findViewById(R.id.textvEspecialidade);
        txtMedico = findViewById(R.id.textvMedico);
       // cvDate.setMinDate((new Date().getTime()));
       // tpTime.setIs24HourView(true);


        if (marcacao != null){

            antiHorario = SingletonGestorHospital.getInstance(getApplicationContext()).gethorario(marcacao.getId());
            // setTitle("Detalhes"+livro.getTitulo());
            carregarDetalhesMarcacao();
            fab.setImageResource(R.drawable.ic_action_guardar);
        }else{
            tvMedico.setVisibility(View.GONE);
            tvEspecialidade.setVisibility(View.GONE);
            setTitle("Marcar");
            fab.setImageResource(R.drawable.ic_action_adicionar);
           /* arrayAdapter=new ArrayAdapter<>(getApplicationContext(), android.R.layout.simple_spinner_item, especialidade);
            spEspecialidade.setAdapter(arrayAdapter);*/

        }

        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(HospitalJsonParser.isConnectionInternet(getApplicationContext())){
                    if (marcacao!=null){
                        atualHorario = SingletonGestorHospital.getInstance(getApplicationContext()).gethorario(id_horario);
                        ///marcacao.setDate(date);
                      //  marcacao.setTempo(time = validarHoras());
                        antiHorario.setUsado(0);
                        atualHorario.setUsado(1);

                        marcacao.setId(id_horario);
                        marcacao.setAceitar(0);
                        SingletonGestorHospital.getInstance(getApplicationContext()).editarHorarioAPI(antiHorario,getApplicationContext());
                        SingletonGestorHospital.getInstance(getApplicationContext()).editarHorarioAPI(atualHorario,getApplicationContext());
                        SingletonGestorHospital.getInstance(getApplicationContext()).editarMarcacaoAPI(marcacao,getApplicationContext(),antiHorario.getId());

                    }
                    else if (validarMarcaco()==true){
                        //time = validarHoras();


                        marcacao = new Marcacao(id_horario,id_especialidade,id_user,id_medico,0);
                        Horario horario = SingletonGestorHospital.getInstance(getApplicationContext()).gethorario(id_horario);
                        horario.setUsado(1);
                        SingletonGestorHospital.getInstance(getApplicationContext()).editarHorarioAPI(horario,getApplicationContext());
                        SingletonGestorHospital.getInstance(getApplicationContext()).adicionarMarcacaoAPI(marcacao,getApplicationContext());

                    }else return;
                    // setResult(RESULT_OK);
                    //finish();
                }

            }
        });




        spEspecialidade.setOnItemSelectedListener(new OnItemSelectedListener() {

            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int position, long id) {
                medico = SingletonGestorHospital.getInstance(getApplicationContext()).getMedicos(id);
                spMedico.setAdapter(new AdapterNomeMedicos(getApplicationContext(),medico));
                id_especialidade = (int) id;
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {

            }

        });


        spMedico.setOnItemSelectedListener(new OnItemSelectedListener() {

            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int position, long id) {
                id_medico = (int) id;
                horarios = SingletonGestorHospital.getInstance(getApplicationContext()).gethorarios(id);
                spHorario.setAdapter(new AdapterHorario(getApplicationContext(),horarios));
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {

            }

        });

        spHorario.setOnItemSelectedListener(new OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int position, long id) {
                id_horario = (int) id;
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {

            }
        });


    }


    private void carregarDetalhesMarcacao() {
        spEspecialidade.setVisibility(View.GONE);
        spMedico.setVisibility(View.GONE);


        /*ArrayList<Especialidade> especialidades = new ArrayList<>();
        ArrayList<Profile> profiles = new ArrayList<>();
        especialidades = SingletonGestorHospital.getInstance(getApplicationContext()).getArrayEspecialidade(marcacao.getId_especialidade());
        spEspecialidade.setAdapter(new AdapterEspecialidade(getApplicationContext(),especialidades));
        profiles = SingletonGestorHospital.getInstance(getApplicationContext()).getArrayMedico(marcacao.getId_Medico());
        spMedico.setAdapter(new AdapterNomeMedicos(getApplicationContext(),profiles));*/
        Especialidade espec = SingletonGestorHospital.getInstance(getApplicationContext()).getEspecialidade(marcacao.getId_especialidade());
        Profile prof = SingletonGestorHospital.getInstance(getApplicationContext()).getProfile(marcacao.getId_Medico());
        tvEspecialidade.setText(espec.getName());
        tvMedico.setText(prof.getFirst_name()+ " "+ prof.getLast_name());

        horarios = SingletonGestorHospital.getInstance(getApplicationContext()).gethorarios(marcacao.getId_Medico());
        spHorario.setAdapter(new AdapterHorario(getApplicationContext(),horarios));

    }

    private boolean validarMarcaco() {
        return true;
    }


    @Override
    public void onRefreshListaMarcacoes(ArrayList<Marcacao> marcacoes) {
        //Para listas
    }

    @Override
    public void onRefreshdetalhesMarcacoes() {
        setResult(RESULT_OK);
        finish();
    }



    @Override
    public void onRefreshListaEspecialidade(ArrayList<Especialidade> especialidades) {
        spEspecialidade.setAdapter(new AdapterEspecialidade(getApplicationContext(),especialidades));
      /*  if (marcacao!= null){
            Especialidade especialidade1 = SingletonGestorHospital.getInstance(getApplicationContext()).getEspecialidade(marcacao.getId_especialidade());
            tvEspecialidade.setText(especialidade1.getName());
            Profile profile = SingletonGestorHospital.getInstance(getApplicationContext()).getProfile(marcacao.getId_Medico());
            tvMedico.setText(profile.getFirst_name() +" "+profile.getLast_name());
        }*/
        especialidade = especialidades;
    }


    @Override
    public void onRefreshListaMedicoEspecialidade(ArrayList<MedicoEspecialidade> medicoEspecialidade) {
        medicoEspecialidades = medicoEspecialidade;
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        if (marcacao!= null){
            MenuInflater inflater=getMenuInflater();
            inflater.inflate(R.menu.menu_remover_marcaco,menu);
            return super.onCreateOptionsMenu(menu);
        }
        return false;
    }

    /**
     * ejetar operações do um item do menu é clicado
     * @param item
     * @return
     */
    @Override
    public boolean onOptionsItemSelected(@NonNull MenuItem item) {
        switch (item.getItemId()){
            case R.id.remover:
                if(HospitalJsonParser.isConnectionInternet(getApplicationContext())){
                    dialogRemover();
                }else return true;
                break;
        }
        return super.onOptionsItemSelected(item);
    }

    private void dialogRemover() {
        AlertDialog.Builder builder= new AlertDialog.Builder(this);
        builder.setTitle("Remover Marcação").setMessage("Pretende mesmo remover esta marcação?").setIcon(android.R.drawable.ic_delete)
                .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        marcacao.setAceitar(0);
                        SingletonGestorHospital.getInstance(getApplicationContext()).editarHorarioAPI(antiHorario,getApplicationContext());
                        SingletonGestorHospital.getInstance(getApplicationContext()).removerMarcacaoAPI(marcacao,getApplicationContext());
                    }
                })
                .setNegativeButton(android.R.string.no, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        // não vai fazer nada
                    }
                }).show();
    }
}
