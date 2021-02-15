package amsi.dei.estg.ipleiria.healthschedule.adaptors;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.model.Diagnostico;
import amsi.dei.estg.ipleiria.healthschedule.model.Receita;

public class AdapterReceitas extends BaseAdapter {


    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Receita> receitas;

    public AdapterReceitas(Context context, ArrayList<Receita> receitas) {
        this.context = context;
        this.receitas = receitas;
    }

    @Override
    public int getCount() {
        return receitas.size();
    }

    @Override
    public Object getItem(int i) {
        return receitas.get(i);
    }

    @Override
    public long getItemId(int i) {
        return receitas.get(i).getId();
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        if (inflater == null)
            inflater = (LayoutInflater) context.getSystemService(context.LAYOUT_INFLATER_SERVICE);
        if (view == null)
            view = inflater.inflate(R.layout.item_lista_receitas, null);

        //otimização
        ViewHolderLista viewHolderLista = (ViewHolderLista) view.getTag();
        if (viewHolderLista == null) {
            viewHolderLista = new ViewHolderLista(view);
            view.setTag(viewHolderLista);
        }
        viewHolderLista.update(receitas.get(i));

        return view;
    }

    private class ViewHolderLista {
        private TextView txtMedicamento, txtQuantidade;


        public ViewHolderLista(View view) {
            txtMedicamento = view.findViewById(R.id.txtMedicamento);
            txtQuantidade = view.findViewById(R.id.txtQuantidade);

        }

        public void update(Receita receita) {
           // txtMedicamento.setText(receita.getNome_medicamento());
           // txtQuantidade.setText(receita.getQuantidade() + "");

        }

    }
}
