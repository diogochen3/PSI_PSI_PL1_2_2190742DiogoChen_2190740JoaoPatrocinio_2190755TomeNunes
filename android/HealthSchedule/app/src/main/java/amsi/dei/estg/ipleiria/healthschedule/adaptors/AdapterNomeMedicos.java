package amsi.dei.estg.ipleiria.healthschedule.adaptors;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.model.Especialidade;
import amsi.dei.estg.ipleiria.healthschedule.model.MedicoEspecialidade;
import amsi.dei.estg.ipleiria.healthschedule.model.Profile;

public class AdapterNomeMedicos extends BaseAdapter {


    private Context context;
    private LayoutInflater inflater;
    private ArrayList<MedicoEspecialidade> especialidade;
    private ArrayList<Profile> profiles;

    public AdapterNomeMedicos(Context context, ArrayList<Profile> profiles) {
        this.context = context;
        this.profiles = profiles;
    }

    @Override
    public int getCount() {
        return profiles.size();
    }

    @Override
    public Object getItem(int i) {
        return profiles.get(i);
    }

    @Override
    public long getItemId(int i) {
        return profiles.get(i).getId();
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        if (inflater == null)
            inflater = (LayoutInflater) context.getSystemService(context.LAYOUT_INFLATER_SERVICE);
        if (view == null)
            view = inflater.inflate(R.layout.item_spinner_medicos, null);

        //otimização
        ViewHolderSpinner viewHolderSpinner = (ViewHolderSpinner) view.getTag();
        if (viewHolderSpinner == null) {
            viewHolderSpinner = new ViewHolderSpinner(view);
            view.setTag(viewHolderSpinner);
        }
        viewHolderSpinner.update(profiles.get(i));

        return view;
    }


    private class ViewHolderSpinner {
        private TextView txtNomeMedico;
        // private ImageView imgCapa;

        public ViewHolderSpinner(View view) {
            txtNomeMedico = view.findViewById(R.id.txtNomeMedico);
        }

        public void update(Profile profile) {
            txtNomeMedico.setText(profile.getFirst_name() + " " + profile.getLast_name());




        }

    }
}
