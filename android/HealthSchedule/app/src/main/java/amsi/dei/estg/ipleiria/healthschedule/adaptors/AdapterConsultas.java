package amsi.dei.estg.ipleiria.healthschedule.adaptors;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import amsi.dei.estg.ipleiria.healthschedule.model.Marcacao;
import java.util.ArrayList;

public class AdapterConsultas extends BaseAdapter {

    //public AdapterConsultas(){}

    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Marcacao> marcacoes;

    public AdapterConsultas(Context context, ArrayList<Marcacao> marcacaos) {
        this.context = context;
        this.marcacoes = marcacoes;
    }

    @Override
    public int getCount() {
        return marcacoes.size();
    }

    @Override
    public Object getItem(int i) {
        return marcacoes.get(i);
    }

    @Override
    public long getItemId(int i) {
        return marcacoes.get(i).getId();
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        return null;
    }

    /*@Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        if (inflater==null)
            inflater=(LayoutInflater) context.getSystemService(context.LAYOUT_INFLATER_SERVICE);
        if (view== null)
            view=inflater.inflate(R.layout.item_lista_marcacao, null);

        //otimização
        ViewHolderLista viewHolderLista= (ViewHolderLista) view.getTag();
        if (viewHolderLista==null){
            viewHolderLista=new ViewHolderLista(view);
            view.setTag(viewHolderLista);
        }
        viewHolderLista.update(marcacoes.get(position));

        return view;
    }*/

    /*private class ViewHolderLista{
       // private TextView tvTitulo, tvAutor, tvSerie, tvAno;
       // private ImageView imgCapa;

        /*public ViewHolderLista(View view) {
            tvTitulo=view.findViewById(R.id.tvTitulo);
            tvAutor=view.findViewById(R.id.tvAutor);
            tvSerie=view.findViewById(R.id.tvSerie);
            tvAno=view.findViewById(R.id.tvAno);
            imgCapa=view.findViewById(R.id.imageView2);

        }*/

        /*public void update(Marcacao marcacao){
            /*tvTitulo.setText(marcacao.getTitulo());
            tvAutor.setText(marcacao.getAutor());
            tvSerie.setText(marcacao.getSerie());
            tvAno.setText(marcacao.getAno()+"");
            imgCapa.setImageResource(marcacao.getCapa());
        }*/

}
