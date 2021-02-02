package amsi.dei.estg.ipleiria.healthschedule.views;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.listeners.ProfileListener;
import amsi.dei.estg.ipleiria.healthschedule.model.Profile;
import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;
import amsi.dei.estg.ipleiria.healthschedule.utils.HospitalJsonParser;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.FileProvider;

import android.Manifest;
import android.app.Activity;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.media.MediaScannerConnection;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.os.Environment;
import android.provider.MediaStore;
import android.util.Base64;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.IOException;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

public class AlterarProfileActivity extends AppCompatActivity implements ProfileListener {

    private static final int PERMISSAO_IMAGEM = 1;
    private static final int PERMISSAO_CAMARA = 2;
    private static final int CAMERA_REQUEST = 3;
    private static final int IMAGEM_REQUEST = 4;
    private static final String ID_USER = "ID_USER";
    private TextView etPNome, etApelido, etEmail, etTelefone, etNif, etEndereco, etDNascimento , etgenero, etcodPostal;
    private Profile perfil;
    private Button btnUpload;
    private FloatingActionButton fabEditar;
    private String currentPhotoPath;
    private ImageView imgProfile;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_alterar_profile);

        etPNome = findViewById(R.id.etPNome);
        etApelido = findViewById(R.id.etLNome);
        etEmail = findViewById(R.id.etEmail);
        etTelefone = findViewById(R.id.etTelefone);
        etNif = findViewById(R.id.etNif);
        etEndereco = findViewById(R.id.etEndereco);
        etDNascimento = findViewById(R.id.etDNascimento);
        etgenero = findViewById(R.id.etGenero);
        etcodPostal = findViewById(R.id.etCodPostal);
        imgProfile = findViewById(R.id.imgVProfile);
        btnUpload = findViewById(R.id.btnUpload);
        fabEditar = findViewById(R.id.fabEditar);
        final int id= getIntent().getIntExtra(ID_USER,0);
        perfil = SingletonGestorHospital.getInstance(getApplicationContext()).getProfile(id);

        carregarPerfil();
        SingletonGestorHospital.getInstance(getApplicationContext()).setProfileListener(this);

        fabEditar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (HospitalJsonParser.isConnectionInternet(getApplicationContext())) {
                    SimpleDateFormat formatter = new SimpleDateFormat("yyyy-MM-dd");
                    Date date = null;
                    try {
                        date = formatter.parse(etDNascimento.getText().toString());
                    } catch (ParseException e) {
                        e.printStackTrace();
                    }
                    perfil.setFirst_name(etPNome.getText().toString());
                    perfil.setLast_name(etApelido.getText().toString());
                    perfil.setEmail(etEmail.getText().toString());
                    perfil.setPhone_number(Integer.parseInt(etTelefone.getText().toString()));
                    perfil.setNIF(Integer.parseInt(etNif.getText().toString()));
                    perfil.setAddress(etEndereco.getText().toString());
                    perfil.setBirth_date(date);
                    perfil.setGender(etgenero.getText().toString());
                    perfil.setPostal_code(etcodPostal.getText().toString());

                    SingletonGestorHospital.getInstance(getApplicationContext()).editarProfileAPI(perfil, getApplicationContext());
                }
            }
        });

        btnUpload.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                final CharSequence[] options = { "Foto", "Gallery","Cancel" };
                AlertDialog.Builder builder = new AlertDialog.Builder(AlterarProfileActivity.this);
                builder.setTitle("Choose your profile picture").setSingleChoiceItems(options, -1, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int item) {
                        if (item == 0) {
                            if (Build.VERSION.SDK_INT >= 23)
                            {
                                if (ActivityCompat.checkSelfPermission(getApplicationContext(), Manifest.permission.CAMERA) == PackageManager.PERMISSION_DENIED ||
                                        ActivityCompat.checkSelfPermission(getApplicationContext(), Manifest.permission.WRITE_EXTERNAL_STORAGE) == PackageManager.PERMISSION_DENIED)

                                    ActivityCompat.requestPermissions(AlterarProfileActivity.this, new String[]{Manifest.permission.CAMERA,Manifest.permission.WRITE_EXTERNAL_STORAGE}, PERMISSAO_CAMARA);
                                else
                                    tirarFotoCamera();
                            }


                        }  else if (item == 1){
                            if (Build.VERSION.SDK_INT >= 23 && ActivityCompat.checkSelfPermission(getApplicationContext(),
                                    Manifest.permission.READ_EXTERNAL_STORAGE) == PackageManager.PERMISSION_DENIED)
                                ActivityCompat.requestPermissions(AlterarProfileActivity.this,
                                        new String[]{Manifest.permission.READ_EXTERNAL_STORAGE}, PERMISSAO_IMAGEM);
                            else
                                carregarFotoGaleria();

                        } else if (item == 2) {
                            dialogInterface.dismiss();
                        }
                    }
                }).show();
            }
        });

    }

    public void onRequestPermissionsResult(int requestCode, String[] permissions, int[] grantResults) {

        switch (requestCode) {
            case PERMISSAO_CAMARA:
                if (grantResults[0] == PackageManager.PERMISSION_GRANTED)
                    tirarFotoCamera();
                break;
            case PERMISSAO_IMAGEM:
                if (grantResults[0] == PackageManager.PERMISSION_GRANTED)
                    carregarFotoGaleria();
                break;
        }
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
    }

    private void carregarFotoGaleria() {
        Intent intent = new Intent();
        intent.setType("image/*");
        intent.setAction(Intent.ACTION_GET_CONTENT);
        startActivityForResult(intent, IMAGEM_REQUEST);
    }

    private void tirarFotoCamera() {
        Intent intent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
        File photoFile = null;
        try {
            photoFile = criarFicheiroImagem();
        } catch (IOException ex) {
            ex.printStackTrace();
        }
        if (photoFile != null) {
            Uri photoURI = FileProvider.getUriForFile(this,
                    getPackageName()+".fileprovider", photoFile);
            intent.putExtra(MediaStore.EXTRA_OUTPUT, photoURI);
            startActivityForResult(intent, CAMERA_REQUEST);
        }
    }

    private File criarFicheiroImagem() throws IOException {
        String timeStamp = new SimpleDateFormat("yyyyMMdd_HHmmss").format(new Date());
        String imgNomeFich = "JPEG_" + timeStamp + "_";
        File storageDir = new
                File(Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_PICTURES)
                .getParentFile(),"profiles");
        storageDir.mkdirs();
        File imagem = File.createTempFile(imgNomeFich, ".jpg", storageDir);
        currentPhotoPath = imagem.getAbsolutePath();
        return imagem;
    }

    public void onActivityResult(int requestCode, int resultCode, Intent intent) {

        switch (requestCode) {
            case CAMERA_REQUEST:
                if (resultCode == Activity.RESULT_OK) {
                    String[] paths = new String[]{currentPhotoPath};
                    Bitmap bitmap = BitmapFactory.decodeFile(currentPhotoPath);
                    imgProfile.setImageBitmap(bitmap);
                    MediaScannerConnection.scanFile(this, paths, null, new
                            MediaScannerConnection.MediaScannerConnectionClient() {

                                @Override
                                public void onMediaScannerConnected() {
                                    Log.d("Detalhes", "onScanCompleted");
                                }

                                @Override
                                public void onScanCompleted(String path, Uri uri) {
                                    Log.d("Detalhes", "onScanCompleted");
                                }
                            });
                }
                break;
            case IMAGEM_REQUEST:
                imgProfile.setImageURI(intent.getData());
                break;

        }
        super.onActivityResult(requestCode, resultCode, intent);
    }

    private void carregarPerfil() {
        etPNome.setText(perfil.getFirst_name());
        etApelido.setText(perfil.getLast_name());
        etEmail.setText(perfil.getEmail());
        etTelefone.setText(String.valueOf(perfil.getPhone_number()));
        etNif.setText(String.valueOf(perfil.getNIF()));
        etEndereco.setText(perfil.getAddress());
        SimpleDateFormat formatter = new SimpleDateFormat("yyyy-MM-dd");//formating according to my need
        String date = formatter.format(perfil.getBirth_date());
        etDNascimento.setText(date);
        etgenero.setText(perfil.getGender());
        etcodPostal.setText(perfil.getPostal_code());

        //etPNome.setEnabled(false);
        etApelido.setEnabled(false);
        etEmail.setEnabled(false);
        etTelefone.setEnabled(false);
        etNif.setEnabled(false);
        etEndereco.setEnabled(false);
        etDNascimento.setEnabled(false);
        etgenero.setEnabled(false);
        etcodPostal.setEnabled(false);
    }

    public String getStringImage(Bitmap bmp) {
        ByteArrayOutputStream baos = new ByteArrayOutputStream();
        bmp.compress(Bitmap.CompressFormat.JPEG, 100, baos);
        byte[] imageBytes = baos.toByteArray();
        String encodedImage = Base64.encodeToString(imageBytes, Base64.DEFAULT);
        return encodedImage;
    }

    @Override
    public void onRefreshListaProfiles(ArrayList<Profile> profiles) {

    }

    @Override
    public void onRefreshdetalhesProfiles() {
        setResult(RESULT_OK);
        finish();
    }
}