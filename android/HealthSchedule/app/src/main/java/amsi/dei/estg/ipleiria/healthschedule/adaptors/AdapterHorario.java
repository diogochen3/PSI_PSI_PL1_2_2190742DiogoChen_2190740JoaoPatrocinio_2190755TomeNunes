package amsi.dei.estg.ipleiria.healthschedule.adaptors;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.model.Horario;


public class AdapterHorario  extends BaseAdapter {

    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Horario> horarios;

    public AdapterHorario(Context context, ArrayList<Horario> horarios) {
        this.context = context;
        this.horarios = horarios;
    }

    @Override
    public int getCount() {
        return horarios.size();
    }

    @Override
    public Object getItem(int i) {
        return horarios.get(i);
    }

    @Override
    public long getItemId(int i) {
        return horarios.get(i).getId();
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        if (inflater == null)
            inflater = (LayoutInflater) context.getSystemService(context.LAYOUT_INFLATER_SERVICE);
        if (view == null)
            view = inflater.inflate(R.layout.item_spinner_horario, null);

        //otimização
        ViewHolderSpinner viewHolderLista = (ViewHolderSpinner) view.getTag();
        if (viewHolderLista == null) {
            viewHolderLista = new ViewHolderSpinner(view);
            view.setTag(viewHolderLista);
        }

        viewHolderLista.update(horarios.get(i));

        return view;
    }


    private class ViewHolderSpinner {
        private TextView txtNomeMedico;
        // private ImageView imgCapa;

        public ViewHolderSpinner(View view) {
            txtNomeMedico = view.findViewById(R.id.txtNome);
        }

        public void update(Horario horario) {
            txtNomeMedico.setText(profile.getFirst_name() + " " + profile.getLast_name());

        }
    }


}
