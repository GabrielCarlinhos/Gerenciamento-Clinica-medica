import { Component, OnInit, Output, EventEmitter, Input } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { EspecialidadeService } from 'src/app/services/especialidade.service';
import { first, take } from 'rxjs';
import { Constants } from 'src/app/shared/constants';
import { Router } from '@angular/router';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import { Especialidade } from 'src/app/models/especialidade.model';



@Component({
  selector: 'app-especialidade-form',
  templateUrl: './especialidade-form.component.html',
  styleUrls: ['./especialidade-form.component.scss']
})
export class EspecialidadeFormComponent implements OnInit {

  public genericRequired: string = Constants.genericRequired;

  public form: FormGroup;

  public currencyConfig = Constants.currencyMaskConfig;

  private submited: boolean = false;

  private id_especialidade!: number;

  @Input() set especialidade(especialidade: Especialidade) {
    this.form.patchValue(especialidade);
    this.submit = this.update;
    this.id_especialidade = especialidade.co_especialidade;
  }

  @Output() setEspecialidade = new EventEmitter<Especialidade>();

  constructor(
    private formBuilder: FormBuilder,
    private especialidadeService: EspecialidadeService,
    public activeModal: NgbActiveModal,
    private router: Router,
    private toastr: ToastrService,
  ) {
    this.form = this.formBuilder.group({
      ds_especialidade: [null, Validators.required],
      vl_consulta: [null, Validators.required],
    })
  }

  ngOnInit(): void {

  }

  submit() {
    if (this.form.invalid || this.submited) {
      return;
    }
    this.submited = true;
    this.especialidadeService.create(this.form.value).pipe(first(), take(1)).subscribe((response) => {
      if (response.success) {
        this.toastr.success(response.mensagem, "Sucesso!", Constants.toastOptions);
        this.setEspecialidade.emit(response.data);
        this.activeModal.close()
      }
      this.submited = false;
    })
  }

  update() {
    if (this.form.invalid || this.submited) {
      return;
    }
    this.submited = true;
    this.especialidadeService.update(this.form.value, this.id_especialidade).pipe(first()).subscribe((response) => {
      if (response.success) {
        this.toastr.success(response.mensagem, "Sucesso!", Constants.toastOptions);
        this.activeModal.close();
        this.setEspecialidade.emit();
      }
      this.submited = false;
    })
  }


}
