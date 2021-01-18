package amsi.dei.estg.ipleiria.healthschedule.listeners;

import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.model.Marcacao;
import amsi.dei.estg.ipleiria.healthschedule.model.MedicoEspecialidade;

public interface MedicoEspecialidadeListener {
    void onRefreshListaMedicoEspecialidade(ArrayList<MedicoEspecialidade> medicoEspecialidade);

}
