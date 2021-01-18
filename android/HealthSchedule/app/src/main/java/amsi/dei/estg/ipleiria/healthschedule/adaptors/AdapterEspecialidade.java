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


public class AdapterEspecialidade extends BaseAdapter {


    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Especialidade> especialidades;

    public AdapterEspecialidade(Context context, ArrayList<Especialidade> especialidades) {
        this.context = context;
        this.especialidades = especialidades;
    }

    @Override
    public int getCount() {
        return especialidades.size();
    }

    @Override
    public Object getItem(int i) {
        return especialidades.get(i);
    }

    @Override
    public long getItemId(int i) {
        return especialidades.get(i).getId();
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        if (inflater == null)
            inflater = (LayoutInflater) context.getSystemService(context.LAYOUT_INFLATER_SERVICE);
        if (view == null)
            view = inflater.inflate(R.layout.item_spinner_especialidade, null);

        //otimização
        ViewHolderSpinner viewHolderSpinner = (ViewHolderSpinner) view.getTag();
        if (viewHolderSpinner == null) {
            viewHolderSpinner = new ViewHolderSpinner(view);
            view.setTag(viewHolderSpinner);
        }
        viewHolderSpinner.update(especialidades.get(i));

        return view;
    }


    private class ViewHolderSpinner {
        private TextView txtNomeEspecialidade;
        // private ImageView imgCapa;

        public ViewHolderSpinner(View view) {
            txtNomeEspecialidade = view.findViewById(R.id.txtNomeEspecialidade);
        }

        public void update(Especialidade especialidade) {
            txtNomeEspecialidade.setText(especialidade.getName());
        }

    }
}
