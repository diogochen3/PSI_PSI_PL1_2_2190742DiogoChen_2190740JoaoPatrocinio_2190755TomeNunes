package amsi.dei.estg.ipleiria.healthschedule.views;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.model.Especialidade;
import amsi.dei.estg.ipleiria.healthschedule.model.Profile;
import androidx.appcompat.app.AppCompatActivity;

import android.app.TimePickerDialog;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TimePicker;

import java.util.ArrayList;
import java.util.Calendar;

public class MarcacaoActivity extends AppCompatActivity {

    ArrayList<Profile> medico;
    ArrayList<Especialidade> especialidades;

    private Spinner spMedico, spEspecialidade;
private ArrayAdapter arrayAdapter;
   private ArrayList<String> esp;

    private EditText etTime;
    private TimePickerDialog timePickerDialog;
    private Calendar calendar;
    int currentHour;
    int currentMinute;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_marcacao);

        spEspecialidade = findViewById(R.id.spEspecialidade);
        spMedico = findViewById( R.id.spMedico);

        arrayAdapter=new ArrayAdapter<>(getApplicationContext(), android.R.layout.simple_spinner_item, esp);

        spEspecialidade.setAdapter(arrayAdapter);


        spMedico.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int position, long id) {
                if (position== 0)
                {
                    arrayAdapter=new ArrayAdapter<>(getApplicationContext(), android.R.layout.simple_spinner_item, medico);
                }
                //spMedico.setAdapter(medico);
            }
        });





        etTime = findViewById(R.id.etTime);
        etTime.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                calendar = Calendar.getInstance();
                currentHour = calendar.get(Calendar.HOUR_OF_DAY);
                currentMinute = calendar.get(Calendar.MINUTE);

                timePickerDialog = new TimePickerDialog(getApplicationContext(), new TimePickerDialog.OnTimeSetListener() {
                    @Override
                    public void onTimeSet(TimePicker timePicker, int hourOfDay, int minute) {
                        etTime.setText(hourOfDay +":"+ minute);
                    }

                },currentHour,currentMinute,false);

                timePickerDialog.show();
            }
        });

    }

}