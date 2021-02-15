package amsi.dei.estg.ipleiria.healthschedule.adaptors;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;

import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.model.Receita;
import amsi.dei.estg.ipleiria.healthschedule.model.ReceitaMedicamento;
import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;

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
        private TextView txtcodAcesso, txtcodDispensa, txtDataEmissao;
        private ListView lvMedicamento;

        public ViewHolderLista(View view) {
            txtcodAcesso = view.findViewById(R.id.txtCodAcesso);
            txtcodDispensa = view.findViewById(R.id.txtCodDispensa);
            txtDataEmissao = view.findViewById(R.id.txtDataemissao);
            lvMedicamento = view.findViewById(R.id.lv_medicamento);
        }

        public void update(Receita receita) {
            txtcodAcesso.setText(receita.getCodigo_acesso()+"");
            txtcodDispensa.setText(receita.getCodigo_dispensa()+"");
            txtDataEmissao.setText(receita.getData_emissao());
       //     ArrayList<ReceitaMedicamento> receitaMedicamentos = SingletonGestorHospital.getInstance(context).getMedicamentoReceita(receita.getId()) ;


        }

    }
}
