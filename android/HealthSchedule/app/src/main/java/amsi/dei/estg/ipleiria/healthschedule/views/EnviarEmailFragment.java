package amsi.dei.estg.ipleiria.healthschedule.views;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.EditText;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

import amsi.dei.estg.ipleiria.healthschedule.R;


public class EnviarEmailFragment extends Fragment {

    private FloatingActionButton fabSend;
    private EditText etSubject, etBody;
    public EnviarEmailFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_enviar_email, container, false);
        setHasOptionsMenu(true);

        fabSend = view.findViewById(R.id.fabSend);
        etSubject = view.findViewById(R.id.etSubject);
        etBody = view.findViewById(R.id.etBody);



        fabSend.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent emailIntent = new Intent(Intent.ACTION_SEND);
                emailIntent.setData(Uri.parse("mailto:tome.nunes800@gmail.com"));
                emailIntent.setType("text/plain");
                emailIntent.putExtra(Intent.EXTRA_EMAIL  , new String[]{"tome.nunes80@gmail.com"});
                emailIntent.putExtra(Intent.EXTRA_SUBJECT, etSubject.getText());
                emailIntent.putExtra(Intent.EXTRA_TEXT, etBody.getText());
                startActivity(Intent.createChooser(emailIntent, "A enviar..."));
            }
        });

        return view;
    }
}