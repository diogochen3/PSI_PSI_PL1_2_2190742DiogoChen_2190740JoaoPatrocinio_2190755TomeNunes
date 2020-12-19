package amsi.dei.estg.ipleiria.healthschedule.views;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.listeners.HospitalLoginListener;
import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;
import amsi.dei.estg.ipleiria.healthschedule.utils.HospitalJsonParser;
import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

public class LoginActivity extends AppCompatActivity  implements HospitalLoginListener {

    private EditText etNif;
    private EditText etPass;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        setTitle(getString(R.string.Title_login));

        etNif = findViewById(R.id.etNIF);
        etPass = findViewById(R.id.etPassword);


        SingletonGestorHospital.getInstance(getApplicationContext()).setHospitalLoginListener(this);

    }


    public void onClickLogin(View view) {
        String email = etNif.getText().toString();
        String pass = etPass.getText().toString();

        if (!isNifvalida(email)){
            etNif.setError("NIF invalido");
            return;
        }

        if (!isPasswordvalida(pass)){
            etPass.setError("password invalido");
            return;
        }
        if(HospitalJsonParser.isConnectionInternet(getApplicationContext())){
            Toast.makeText(getApplicationContext(),"É preciso net",Toast.LENGTH_SHORT);
        }else
            SingletonGestorHospital.getInstance(getApplicationContext()).loginAPI(email, pass,getApplicationContext());
    }
    private boolean isNifvalida(String nif){
        if (nif == null){
            return false;
        }
        //Validar se a string tem >=4 caracter
        return nif.length() == 9;
    }

    private boolean isPasswordvalida(String password){
        if (password == null){
            return false;
        }
        //Validar se a string tem >=4 caracter
        return password.length() >= 4;
    }



    @Override
    public void onValidateLogin(String token, String email) {

    }


}